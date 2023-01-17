<?php

namespace App\Http\Controllers;

use App\GenerateAccountNumber;
use App\Models\Account;
use App\Services\CurrencyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function createAccount(Request $request): RedirectResponse
    {
        Account::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => (new GenerateAccountNumber)->generateAccountNumber(),
            'currency' => $request->input('currency'),
            'balance' => 0
        ]);
        return \redirect('accounts');
    }

}
