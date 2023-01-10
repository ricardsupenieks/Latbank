<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\Currency\ExchangeRatesApiRepository;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    public function exchangeRateFor($currencySymbol): float
    {
        $exchangeRates = (new ExchangeRatesApiRepository())->getCurrencyInformation();

        return $exchangeRates['rates'][$currencySymbol];
    }

    public function getCurrencies(): array
    {
        if(Cache::get('currencies') == null) {
            $exchangeRates = (new ExchangeRatesApiRepository())->getCurrencyInformation();

            unset($exchangeRates['rates']["BTC"]);

            Cache::put('currencies', array_keys($exchangeRates['rates']));
        }

        return Cache::get('currencies');
    }
}
