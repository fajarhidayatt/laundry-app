<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'packet_id',
        'qty',
        'total_price',
        'info',
        'total_payment',
    ];

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }
}
