<?php

namespace App\Http\Controllers;

use App\Services\CryptoService;
use Illuminate\View\View;

class CryptoMarketController extends Controller
{
    private CryptoService $cryptoService;
    public function __construct()
    {
        $this->cryptoService = new CryptoService();
    }

    public function showMainPage(): View
    {
        $topCryptos = $this->cryptoService->getTopCryptos();

        return view('market', ['topCryptos' => $topCryptos]);
    }

    public function showCrypto($cryptoId): View
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        return view('crypto', ['crypto' => $crypto]);
    }

    public function buyCrypto($cryptoId): View
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        return view('crypto', ['crypto' => $crypto]);
    }

    public function sellCrypto($cryptoId): View
    {
        $crypto = $this->cryptoService->getCryptoById($cryptoId);

        return view('crypto', ['crypto' => $crypto]);
    }
}
