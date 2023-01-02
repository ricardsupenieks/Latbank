<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $accountId = $request->input('account_id');
        $account = json_decode(Account::whereId($accountId)->get()[0]);

        $rates = new ExchangeRate();

        $currentBalance = $account->balance;
        $currentCurrency = $account->currency;

        $chosenCurrency = $request->input('currency');

        if($currentCurrency == 'EUR') {
           Account::whereId($accountId)->update([
                'balance' => $currentBalance * $rates->exchangeTo($chosenCurrency),
                'currency' => $chosenCurrency,
            ]);
        } else if($chosenCurrency == 'EUR') {
            Account::whereId($accountId)->update([
                'balance' => $currentBalance / $rates->exchangeTo($currentCurrency),
                'currency' => $chosenCurrency,
            ]);
        } else {
            Account::whereId($accountId)->update([
                'balance' =>  ($currentBalance / $rates->exchangeTo($currentCurrency)) * $rates->exchangeTo($chosenCurrency),
                'currency' => $chosenCurrency,
            ]);
        }
        return redirect('/accounts');
    }
}
