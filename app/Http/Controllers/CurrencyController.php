<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
//    public function index(Request $request): RedirectResponse
//    {
//        $accountId = $request->input('account_id');
//        $account = Account::whereId($request->input('account_id'))->get();
//
//        $rates = new ExchangeRate();
//
//        $currentBalance = $account->balance;
//        $currentCurrency = $account->currency;
//
//        $chosenCurrency = $request->input('currency');
//
//        if($currentCurrency == 'EUR') {
//           Account::whereId($accountId)->update([
//                'balance' => $currentBalance * $rates->exchangeRateFor($chosenCurrency),
//                'currency' => $chosenCurrency,
//            ]);
//        } else if($chosenCurrency == 'EUR') {
//            Account::whereId($accountId)->update([
//                'balance' => $currentBalance / $rates->exchangeRateFor($currentCurrency),
//                'currency' => $chosenCurrency,
//            ]);
//        } else {
//            Account::whereId($accountId)->update([
//                'balance' =>  ($currentBalance / $rates->exchangeRateFor($currentCurrency)) * $rates->exchangeRateFor($chosenCurrency),
//                'currency' => $chosenCurrency,
//            ]);
//        }
//        return redirect('/accounts');
//    }
}
