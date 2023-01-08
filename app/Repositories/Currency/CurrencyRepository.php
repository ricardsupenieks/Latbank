<?php

namespace App\Repositories\Currency;

interface CurrencyRepository
{
    public function getCurrencyInformation(): array;
}
