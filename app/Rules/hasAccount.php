<?php

namespace App\Rules;

use App\Models\Account;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class hasAccount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $accountOwner;
    public function __construct($accountNumber)
    {
        $account = json_decode(Account::whereAccountNumber($accountNumber)->pluck('owner_id'), true);
        $this->accountOwner = json_decode(User::whereId($account)->pluck('full_name'), true);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(array(mb_strtoupper($value)) == $this->accountOwner){
            return true;
        }
        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect recipients credentials.';
    }
}
