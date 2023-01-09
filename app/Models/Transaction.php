<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'transferee',
        'transferor',
        'account_to',
        'account_from',
        'owner_id',
        'currency',
        'amount',
        'transaction',
    ];
}
