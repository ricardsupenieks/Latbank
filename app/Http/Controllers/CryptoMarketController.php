<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Code;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
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

    public function showSearch(Request $request): RedirectResponse
    {
        $search = $request->get('search');

        $searchBySlug = $this->cryptoService->getCryptoBySlug($search);

        if($searchBySlug == 0) {
            $searchBySymbol = $this->cryptoService->getCryptoBySymbol($search) == 0;

            if(!$searchBySymbol) {
                return redirect('/crypto');
            }
            return redirect('/crypto/' . $searchBySymbol);
        }
        return redirect('/crypto/' . $searchBySlug);
    }

    public function showCrypto($cryptoId): View
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        if(empty($crypto)) {
            abort(404);
        }

        $allAccounts = Account::whereOwnerId(Auth::user()->getAuthIdentifier())->get();
        $cryptoAccountIds = CryptoCurrency::whereCryptoId((int)$cryptoId)->pluck('account_id');

        $cryptoAccounts = [];

        if (!$cryptoAccountIds->isEmpty()) {
            $cryptoAccounts = Account::whereId($cryptoAccountIds)->get();
        }

        $codes = json_decode(Code::whereOwnerId(Auth::user()->getAuthIdentifier())->get(), true);
        $randomCodeId = array_rand($codes);

        return view('crypto', [
            'crypto' => $crypto,
            'accounts' => $allAccounts,
            'cryptoAccounts' => $cryptoAccounts,
            'code' => $codes[$randomCodeId],
        ]);
    }

    public function buyCrypto($cryptoId, Request $request): RedirectResponse
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        if(empty($crypto)) {
            abort(404);
        }

        $minimumCryptoAmount = 1;

        if($crypto['quote']['EUR']['price'] >= 1) {
            $minimumCryptoAmount = sprintf("%.10f", 1 / $crypto['quote']['EUR']['price']);
        }

        $request->validate([
            'account' => ['required', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:' . $minimumCryptoAmount],
            'code_input' => ['required', 'exists:codes,code'],
        ]);

        $account = Account::whereAccountNumber($request->get('account'))->get()->first();
        if($account->owner_id !== Auth::id()) {
            abort(403);
        }

        $exchangeRateForAccountCurrency = $this->currencyService->exchangeRateFor($account->currency);

        $totalPrice = $crypto['quote']['EUR']['price'] * (int)$request->get('amount');
        $totalPriceConverted = $totalPrice * $exchangeRateForAccountCurrency;
        $totalPriceConvertedInCents = $totalPriceConverted * 100;

        if($totalPriceConvertedInCents > $account->balance) {
            return back()->withErrors([
                'total' => 'Insufficient funds',
            ])->onlyInput('amount');
        }

        $account->update(['balance' => $account->balance - $totalPriceConvertedInCents]);

        $ownedCrypto = CryptoCurrency::whereOwnerId(Auth()->user()->getAuthIdentifier())->where('crypto_id', $cryptoId);
        if($ownedCrypto->get()->isEmpty()) {
            CryptoCurrency::create([
                'owner_id' => Auth()->user()->getAuthIdentifier(),
                'account_id' => $account->id,
                'crypto_id' => (int)$cryptoId,
                'symbol' => $crypto['symbol'],
                'name' => $crypto['name'],
                'price' => $totalPriceConvertedInCents,
                'amount' => $request->get('amount'),
            ]);
        } else {
            $ownedCrypto->update([
                'amount' => $ownedCrypto->get()->first()['amount'] + $request->get('amount'),
                'price' => $ownedCrypto->price + $totalPriceConvertedInCents
            ]);
        }

        CryptoTransaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => $request->get('account'),
            'crypto' => $crypto['symbol'],
            'transaction' => 'buy',
            'amount' => $request->get('amount'),
            'price' => $totalPriceConvertedInCents
        ]);

        return redirect('/crypto/portfolio/' . $account->id);
    }

    public function sellCrypto($cryptoId, Request $request): RedirectResponse
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        if(empty($crypto)) {
            abort(404);
        }

        $minimumCryptoAmount = 1;

        if($crypto['quote']['EUR']['price'] >= 1) {
            $minimumCryptoAmount = sprintf("%.10f", 1 / $crypto['quote']['EUR']['price']);
        }

        $request->validate([
            'account' => ['required', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:' . $minimumCryptoAmount],
            'code_input' => ['required', 'exists:codes,code'],
        ]);

        $account = Account::whereAccountNumber($request->get('account'))->get()->first();
        if($account->owner_id !== Auth::id()) {
            abort(403);
        }

        $exchangeRateForAccountCurrency = $this->currencyService->exchangeRateFor($account->currency);

        $totalPrice = $crypto['quote']['EUR']['price'] * (int)$request->get('amount');
        $totalPriceConverted = $totalPrice * $exchangeRateForAccountCurrency;
        $totalPriceConvertedInCents = $totalPriceConverted * 100;

        $ownedCrypto = CryptoCurrency::whereOwnerId(Auth()->user()->getAuthIdentifier())->where('crypto_id', $cryptoId);

        $amount = $request->get('amount');
        if ($amount >= $ownedCrypto->get()->first()['amount']) {
            $amount = $ownedCrypto->get()->first()['amount'];
            CryptoCurrency::destroy($ownedCrypto->get()->first()['id']);
        } else {
            $ownedCrypto->update([
                'amount' => $ownedCrypto->get()->first()['amount'] - $amount,
                'price_sold' => $ownedCrypto->get()->first()['price_sold'] + $totalPriceConvertedInCents
            ]);
        }

        $account->update(['balance' => $account->balance + $totalPriceConvertedInCents]);

        CryptoTransaction::create([
            'owner_id' => Auth()->user()->getAuthIdentifier(),
            'account_number' => $request->get('account'),
            'crypto' => $crypto['symbol'],
            'transaction' => 'sell',
            'amount' => sprintf("%.10f", $amount),
            'price' => $totalPriceConvertedInCents
        ]);

        return redirect('/crypto/portfolio/' . $account->id);
    }
}
