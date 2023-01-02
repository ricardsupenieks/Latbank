<?php

namespace App;

use App\Models\Account;

class GenerateAccountNumber
{
    function generateAccountNumber()
    {
        $number = mt_rand(100000000000,999999999999);

        if ($this->accountNumberExists($number)) {
            return $this->generateAccountNumber();
        }

        return $number;
    }

    function accountNumberExists($number)
    {
        return Account::whereAccountNumber($number)->exists();
    }
}
