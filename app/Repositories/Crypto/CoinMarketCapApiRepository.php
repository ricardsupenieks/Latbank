<?php

namespace App\Repositories\Crypto;

use App\CryptoUrlResponse;

class CoinMarketCapApiRepository implements CryptoRepository
{
    public function getTopCryptos(): array {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => '75',
            'convert' => 'USD'
        ];

        return (new CryptoUrlResponse($url, $parameters))->get()['data'];
    }

    public function getCrypto($cryptoId): array {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/' . $cryptoId;
        $parameters = [
            'start' => '1',
            'limit' => '1',
            'convert' => 'USD'
        ];

        return (new CryptoUrlResponse($url, $parameters))->get()['data'];
    }

}
