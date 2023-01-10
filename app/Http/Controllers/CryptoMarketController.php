<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Models\Transaction;
use App\Services\CryptoService;
use App\Services\CurrencyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CryptoMarketController extends Controller
{
    private CryptoService $cryptoService;
    private CurrencyService $currencyService;
    public function __construct()
    {
        $this->cryptoService = new CryptoService();
        $this->currencyService = new CurrencyService();
    }

    public function showMainPage(): View
    {
        $topCryptos = $this->cryptoService->getTopCryptos();

        return view('market', ['topCryptos' => $topCryptos]);
    }

    public function showCrypto($cryptoId): View
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        if(empty($crypto)) {
            abort(404);
        }

        $accounts = Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get();

        return view('crypto', ['crypto' => $crypto, 'accounts' => $accounts]);
    }

    public function buyCrypto($cryptoId, Request $request): RedirectResponse
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        if(empty($crypto)) {
            abort(404);
        }

        $minimumCryptoAmount = 1;

        if($crypto['quote']['EUR']['price'] >= 1) {
            $minimumCryptoAmount = 1 / $crypto['quote']['EUR']['price'];
        }

        $request->validate([
            'account' => ['required', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:' . $minimumCryptoAmount]
        ]);

        $account = Account::whereAccountNumber($request->get('account'))->get()->first();
        if($account->owner_id !== Auth::id()) {
            abort(403);
        }
        $accountBalance = $account->balance;
        $exchangeRateForAccountCurrency = $this->currencyService->exchangeRateFor($account->currency);

        $totalPrice = $crypto['quote']['EUR']['price'] * (int)$request->get('amount');
        $totalPriceConverted = $totalPrice * $exchangeRateForAccountCurrency;
        if($totalPriceConverted > $accountBalance) {
            return back()->withErrors([
                'total' => 'Insufficient funds',
            ])->onlyInput('amount');
        }

        $account->update(['balance' => $accountBalance - $totalPriceConverted]);

        CryptoCurrency::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_id' => $account->id,
            'crypto_id' => (int)$cryptoId,
            'symbol' => $crypto['symbol'],
            'name' => $crypto['name'],
            'price' => $totalPriceConverted,
            'amount' => $request->get('amount'),
        ]);

        CryptoTransaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => $request->get('account'),
            'crypto' => $crypto['symbol'],
            'transaction' => 'buy',
            'amount' => $request->get('amount'),
        ]);

        return redirect('/crypto/portfolio/' . $account->id);
    }

//    public function sellCrypto($cryptoId): View
//    {
//        $crypto = $this->cryptoService->getCryptoById($cryptoId);
//
//
//        return view('crypto', ['crypto' => $crypto]);
//    }
}
