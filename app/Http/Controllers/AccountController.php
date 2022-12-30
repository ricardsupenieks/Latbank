<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index($accountNumber): View
    {
        $account = json_decode(Account::whereAccountNumber($accountNumber)->get(), true);

        return view('account', ['account' => $account[0]]);
    }

    public function deposit(Request $request): RedirectResponse
    {

        $id = $request->get('id');

        $balance = json_decode(Account::whereId($id)->get('balance'))[0]->balance;

        if($request->get('deposit')) {
            Account::whereId($id)->update(['balance' => $balance + (float)$request->get('amount')]);
        } else {
            Account::whereId($id)->update(['balance' => $balance - (float)$request->get('amount')]);
        }

        return \redirect('/accounts');
    }
}
