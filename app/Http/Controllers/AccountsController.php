<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountsController extends Controller
{
    public function showForm(): View
    {
        $accounts = json_decode(Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get(), true);
        $currencies = (new CurrencyService())->getCurrencies();
        return view('accounts', ['accounts' => $accounts, 'currencies' => $currencies]);
    }

}
