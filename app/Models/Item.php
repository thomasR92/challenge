<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'buy_price',
        'sold_price',
        'price_HT',
        'allergene',
        'exp_date',
        'sold',
    ];
}
