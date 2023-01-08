<?php

namespace App\Repositories\Crypto;

interface CryptoRepository
{
    public function getTopCryptos(): array;
}
