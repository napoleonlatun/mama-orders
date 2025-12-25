<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'username',
        'price',
        'jerseys',
        'livraison',
        'date_of_order',
        'date_of_order_delivered',
        'status',
    ];
}
