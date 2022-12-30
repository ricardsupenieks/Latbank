<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountsController extends Controller
{
    public function showForm(): View
    {
        $accounts = json_decode(Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get(), true);
        return view('accounts', ['accounts' => $accounts]);
    }
}
