<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\Account;
use App\Models\Code;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function showForm(): View
    {
        $accounts = Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get();

        $codes = json_decode(Code::whereOwnerId(Auth::user()->getAuthIdentifier())->get(), true);
        $randomCodeId = array_rand($codes);

        return view('transfer', ['accounts' => $accounts, 'code' => $codes[$randomCodeId]]);
    }

    public function execute(TransferRequest $request): RedirectResponse
    {
        $amount = $request->get('transfer_amount');

        $toAccount =  Account::whereAccountNumber($request->get('recipients_account_number'))->get()->first();
        $fromAccount = Account::whereId($request->get('transfer_from'))->get()->first();

        if($fromAccount->owner_id !== Auth::id()) {
            abort(403);
        }

        $fromAccount->update(['balance' => $fromAccount->balance - $amount]);

        $currencyService = new CurrencyService();

        $exchangeRateFrom = $currencyService->exchangeRateFor($fromAccount->currency);
        $exchangeRateTo = $currencyService->exchangeRateFor($toAccount->currency);

        $amountAfterRate = ($amount / $exchangeRateFrom) * $exchangeRateTo;

        $toAccount->update(['balance' => $toAccount->balance + $amountAfterRate]);

        Transaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'receiver' => $request->get('name'),
            'account' => $toAccount->account_number,
            'currency' => $fromAccount->currency,
            'transaction' => 'transfer',
            'amount' => $amount
        ]);

        Transaction::create([
            'owner_id' => $toAccount->owner_id,
            'receiver' => $request->get('name'),
            'account' => $toAccount->account_number,
            'currency' => $toAccount->currency,
            'transaction' => 'transfer',
            'amount' => $amountAfterRate
        ]);

        return redirect('/transfer');
    }
}
