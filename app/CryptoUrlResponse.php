<?php

namespace App;

class CryptoUrlResponse
{

    private array $parameters;
    private string $url;

    public function __construct($url, $parameters)
    {

        $this->parameters = $parameters;
        $this->url = $url;
    }

    public function get(): array
    {
        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . env('COIN_MARKET_CAP_API_KEY')
        ];
        $qs = http_build_query($this->parameters); // query string encode the parameters
        $request = "{$this->url}?{$qs}"; // create the request URL

        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        curl_close($curl); // Close request
        return json_decode(($response), true); // print json decoded response
    }
}
