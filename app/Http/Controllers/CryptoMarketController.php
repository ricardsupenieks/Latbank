<?php

namespace App\Http\Controllers;

use App\Repositories\Crypto\CoinMarketCapApiRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CryptoMarketController extends Controller
{
    public function showMainPage(): View
    {
        $topCryptos = (new CoinMarketCapApiRepository())->getTopCryptos();

        return view('market', ['topCryptos' => $topCryptos]);
    }

    public function showCrypto(Request $request)
    {
        var_dump($request->get('crypto'));
    }
}
