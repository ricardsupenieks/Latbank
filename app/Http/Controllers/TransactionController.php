<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function showForm(): View
    {
        $transactions = Transaction::whereOwnerId(Auth::user()->getAuthIdentifier())->get();

        return \view('transactions', ['transactions' => $transactions]);
    }
}
