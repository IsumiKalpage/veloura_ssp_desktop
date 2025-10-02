<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MongoOrder extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'shipping_address',
        'shipping_city',
        'shipping_district',
        'shipping_postal',
        'billing_address',
        'billing_city',
        'billing_district',
        'billing_postal',
        'payment_method',
        'notes',
        'items',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'status',
    ];
}
