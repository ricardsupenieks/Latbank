<?php

namespace App;

use App\Models\Code;

class GenerateCode
{
    function generateCode()
    {
        $number = mt_rand(000000,999999);

        if ($this->codeExists($number)) {
            return $this->generateCode();
        }

        return $number;
    }

    function codeExists($number)
    {
        return Code::whereCode($number)->exists();
    }
}
