<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'outlet_id',
        'type',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
