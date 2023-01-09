<?php

namespace App\Http\Controllers;

use App\Services\CryptoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CryptoSearchController extends Controller
{
    private CryptoService $cryptoService;
    public function __construct()
    {
        $this->cryptoService = new CryptoService();
    }

    public function showCrypto(Request $request): RedirectResponse
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
}
