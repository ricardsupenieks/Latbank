<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoCurrency;

class PortfolioController extends Controller
{
    public function showForm($accountId)
    {
        $cryptos = json_decode(CryptoCurrency::whereAccountId($accountId)->get(), true);
        $account = Account::whereId($accountId)->get()->first();

        return view('portfolio', ['cryptos' => $cryptos, 'account' => $account]);
    }
}
