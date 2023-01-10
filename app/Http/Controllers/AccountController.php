<?php

namespace App\Http\Controllers;

use App\GenerateAccountNumber;
use App\Models\Account;
use App\Models\CryptoCurrency;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function showForm($accountNumber): View
    {
        $userAccounts = Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get();
        $account = Account::whereAccountNumber($accountNumber)->get()->first();

        if (!$userAccounts->contains($account)) {
            abort('403');
        }

        $accountId = $account->id;
        $cryptos = json_decode(CryptoCurrency::whereAccountId($accountId)->get(), true);

        return view('account', ['account' => $account, 'cryptos' => $cryptos]);
    }

    public function createAccount(Request $request): RedirectResponse
    {
        Account::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => (new GenerateAccountNumber)->generateAccountNumber(),
            'currency' => $request->input('currency'),
            'balance' => 0.00
        ]);
        return \redirect('accounts');
    }

    public function depositOrWithdraw(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $id = $request->get('id');

        $account = Account::whereId($id)->get()->first();

        if($request->get('deposit')) {
            Account::whereId($id)->update(['balance' => $account->balance + (float)$request->get('amount')]);

            Transaction::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'account' => $account->account_number,
                'currency' => json_decode(Account::whereId($id)->get('currency'))[0]->currency,
                'transaction' => 'deposit',
                'amount' => (float)$request->get('amount')
            ]);
        } else {
            Account::whereId($id)->update(['balance' => $account->balance - (float)$request->get('amount')]);

            Transaction::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'account' => $account->account_number,
                'currency' => json_decode(Account::whereId($id)->get('currency'))[0]->currency,
                'transaction' => 'withdraw',
                'amount' => (float)$request->get('amount')
            ]);
        }

        return \redirect('/accounts');
    }
}
