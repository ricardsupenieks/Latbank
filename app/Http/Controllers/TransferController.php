<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\Account;
use App\Models\Code;
use App\Models\Transaction;
use App\Models\User;
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
        $transferor = User::whereId(Auth()->user()->getAuthIdentifier())->get()->first();

        $amount = $request->get('transfer_amount');
        $amountInCents = $amount * 100;

        $toAccount =  Account::whereAccountNumber($request->get('transfer_to'))->get()->first();
        $fromAccount = Account::whereAccountNumber($request->get('transfer_from'))->get()->first();

        if($fromAccount->owner_id !== Auth::id()) {
            abort(403);
        }

        $fromAccount->update(['balance' => $fromAccount->balance - $amountInCents]);

        $currencyService = new CurrencyService();

        $exchangeRateFrom = $currencyService->exchangeRateFor($fromAccount->currency);
        $exchangeRateTo = $currencyService->exchangeRateFor($toAccount->currency);

        $amountAfterRate = ($amount / $exchangeRateFrom) * $exchangeRateTo;
        $amountAfterRateInCents = $amountAfterRate * 100;

        $toAccount->update(['balance' => $toAccount->balance + $amountAfterRateInCents]);

        if($toAccount->owner_id == Auth()->user()->getAuthIdentifier()) {
            Transaction::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'transferee' => $request->get('name'),
                'transferor' => $transferor->name . ' ' . $transferor->surname,
                'account_to' => $toAccount->account_number,
                'account_from' => $fromAccount->account_number,
                'currency' => $fromAccount->currency,
                'amount' => $amountInCents,
                'transaction' => 'relocate',
            ]);

            return redirect('/transfer')->with('success', 'Redirect successful.');
        }

        Transaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'transferee' => $request->get('name'),
            'transferor' => $transferor->name . ' ' . $transferor->surname,
            'account_to' => $toAccount->account_number,
            'account_from' => $fromAccount->account_number,
            'currency' => $fromAccount->currency,
            'amount' => $amountInCents,
            'transaction' => 'transfer',
        ]);

        Transaction::create([
            'owner_id' => $toAccount->owner_id,
            'transferee' => $transferor->name . ' ' . $transferor->surname,
            'transferor' => $request->get('name'),
            'account_to' => $toAccount->account_number,
            'account_from' => $fromAccount->account_number,
            'currency' => $toAccount->currency,
            'amount' => $amountAfterRateInCents,
            'transaction' => 'receive',
            ]);

        return redirect('/transfer')->with('success', 'Transfer successful.');
    }
}
