<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'metode',
        'jumlah',
        'status_pembayaran',
        'tanggal_bayar'
    ];

    // RELATIONSHIP
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
