<?php

namespace App\Http\Controllers;

use App\GenerateAccountNumber;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateAccountController extends Controller
{
    public function execute(Request $request): RedirectResponse
    {
        Account::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => (new GenerateAccountNumber)->generateAccountNumber(),
            'currency' => $request->input('currency'),
            'balance' => 0.00
        ]);
        return \redirect('accounts');
    }
}
