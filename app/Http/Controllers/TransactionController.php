<?php

namespace App\Http\Controllers;

use App\Models\CryptoTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function showForm()
    {
        $transactions = Transaction::whereOwnerId(Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get();

        $cryptoTransactions = CryptoTransaction::whereOwnerId(Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get();

        return \view('transactions', ['transactions' => $transactions, 'cryptoTransactions' => $cryptoTransactions]);
    }
}
