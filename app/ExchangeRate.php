<?php

namespace App;

class ExchangeRate
{
    /**
     * @var mixed
     */
    private string $access_key;
    private string $endpoint;

    public function __construct()
    {
        $this->endpoint = 'latest';
        $this->access_key = env('EXCHANGE_RATES_API_KEY');
    }

    public function exchangeTo($currencySymbol): float
    {
        $ch = curl_init('http://api.exchangeratesapi.io/v1/'.$this->endpoint.'?access_key='.$this->access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $exchangeRates = json_decode($json, true);

        return $exchangeRates['rates'][$currencySymbol];
    }

    public function getCurrencies(): array
    {
        $ch = curl_init('http://api.exchangeratesapi.io/v1/'.$this->endpoint.'?access_key='.$this->access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $exchangeRates = json_decode($json, true);
        unset($exchangeRates['rates']["BTC"]);

        return array_keys($exchangeRates['rates']);
    }
}
