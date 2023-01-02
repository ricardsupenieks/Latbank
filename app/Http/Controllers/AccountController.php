<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function showForm($accountNumber): View
    {
        $account = json_decode(Account::whereAccountNumber($accountNumber)->get(), true);

        return view('account', ['account' => $account[0]]);
    }

    public function execute(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $id = $request->get('id');

        $balance = json_decode(Account::whereId($id)->get('balance'))[0]->balance;

        if($request->get('deposit')) {
            Account::whereId($id)->update(['balance' => $balance + (float)$request->get('amount')]);

            Transaction::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'currency' => json_decode(Account::whereId($id)->get('currency'))[0]->currency,
                'transaction' => 'deposit',
                'amount' => (float)$request->get('amount')
            ]);
        } else {
            Account::whereId($id)->update(['balance' => $balance - (float)$request->get('amount')]);

            Transaction::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'currency' => json_decode(Account::whereId($id)->get('currency'))[0]->currency,
                'transaction' => 'withdraw',
                'amount' => (float)$request->get('amount')
            ]);
        }

        return \redirect('/accounts');
    }
}
