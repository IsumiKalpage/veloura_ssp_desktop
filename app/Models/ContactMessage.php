<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // Force MySQL in case your default connection switches
    protected $connection = 'mysql';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'ip_address',
        'status',
    ];
}
