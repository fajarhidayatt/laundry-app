<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'invoice',
        'member_id',
        'date',
        'time_limit',
        'payment_date',
        'additional_cost',
        'discount',
        'tax',
        'status',
        'payment_status',
        'user_id',
    ];
}
