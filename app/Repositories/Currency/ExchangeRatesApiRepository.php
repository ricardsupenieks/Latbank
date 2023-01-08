<?php

namespace App\Repositories\Currency;
class ExchangeRatesApiRepository implements CurrencyRepository
{
    private string $access_key;
    private string $endpoint;
    public function __construct()
    {
        $this->endpoint = 'latest';
        $this->access_key = env('EXCHANGE_RATES_API_KEY');
    }
    public function getCurrencyInformation(): array
    {
        $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $this->endpoint . '?access_key=' . $this->access_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        return json_decode($json, true);
    }
}
