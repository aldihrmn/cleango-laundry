<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'jenis_layanan',
        'harga_per_kg',
        'estimasi_hari',
        'deskripsi',
        'is_active',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
