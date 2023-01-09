<?php

namespace App\Repositories\Crypto;

interface CryptoRepository
{
    public function getCrypto($url, $parameters): array;
}
