<?php

namespace App\Repositories\Crypto;

class CoinMarketCapApiRepository implements CryptoRepository
{
    public function getCrypto($url, $parameters): array {
        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . env('COIN_MARKET_CAP_API_KEY')
        ];
        $qs = http_build_query($parameters);
        $request = "{$url}?{$qs}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => 1
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode(($response), true);
    }
}
