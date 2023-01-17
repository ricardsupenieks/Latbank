<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'account_id',
        'crypto_id',
        'symbol',
        'name',
        'price',
        'price_sold',
        'amount',
    ];
}
