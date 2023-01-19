<?php

namespace App\Http\Controllers;

use App\GenerateAccountNumber;
use App\Models\Account;
use App\Models\Code;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function showForm($accountNumber): View
    {
        $userAccounts = Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get();
        $account = Account::whereAccountNumber($accountNumber)->get()->first();

        if (!$userAccounts->contains($account)) {
            abort('403');
        }

        $accountId = $account->id;
        $cryptos = json_decode(CryptoCurrency::whereAccountId($accountId)->get(), true);

        $transactions = json_decode(Transaction::whereOwnerId(Auth()->user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(), true);

        $cryptoTransactions = CryptoTransaction::whereAccountNumber($accountNumber)->get();

        $codes = json_decode(Code::whereOwnerId(Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->get(), true);
        $randomCodeId = array_rand($codes);

        return view('account', [
            'account' => $account,
            'cryptos' => $cryptos,
            'transactions' => $transactions,
            'cryptoTransactions' => $cryptoTransactions,
            'code' => $codes[$randomCodeId],
        ]);
    }

    public function deposit($accountNumber, Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'code_input' => ['required', 'exists:codes,code'],
        ]);

        $account = Account::whereAccountNumber($accountNumber)->get()->first();
        $accountId = $account->id;

        $userId = $account->owner_id;
        if($userId !== Auth::id()) {
            abort(403);
        }

        $user = User::whereId($userId)->get()->first();

        $amountInCents = $request->get('amount') * 100;

        Account::whereId($accountId)->update(['balance' => $account->balance + $amountInCents]);

        Transaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'transferee' => $user->name . ' ' . $user->surname,
            'transferor' => $user->name . ' ' . $user->surname,
            'account_to' => $account->account_number,
            'account_from' => null,
            'currency' => $account->currency,
            'amount' => $amountInCents,
            'transaction' => 'deposit',
        ]);
        return \redirect('/accounts')->with('success', 'Deposit successful.');
    }

    public function withdraw($accountNumber, Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'code_input' => ['required', 'exists:codes,code'],
        ]);

        $account = Account::whereAccountNumber($accountNumber)->get()->first();
        $accountId = $account->id;

        $userId = $account->owner_id;
        if ($userId !== Auth::id()) {
            abort(403);
        }

        $user = User::whereId($userId)->get()->first();

        $amountInCents = $request->get('amount') * 100;

        if($amountInCents > $account->balance) {
            $amountInCents = $account->balance;
        }

        Account::whereId($accountId)->update(['balance' => $account->balance - $amountInCents]);

        Transaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'transferee' => $user->name . ' ' . $user->surname,
            'transferor' => $user->name . ' ' . $user->surname,
            'account_to' => null,
            'account_from' => $account->account_number,
            'currency' => $account->currency,
            'amount' => $amountInCents,
            'transaction' => 'withdraw',
        ]);
        return \redirect('/accounts')->with('success', 'Withdrawal successful.');
    }
    public function close($accountNumber, Request $request)
    {
        $request->validate([
            'code_input' => ['required', 'exists:codes,code'],
        ]);

        Account::whereAccountNumber($accountNumber)->delete();

        return \redirect('/accounts')->with('success', 'Account ' . $accountNumber . ' has been closed');
    }
}
