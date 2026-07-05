<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'kode_order',
        'tanggal_order',
        'status',
        'pickup_type',
        'estimasi_selesai',
        'total_harga',
        'catatan'
    ];

    // RELATIONSHIP

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(LaundryStatusLog::class);
    }
}
