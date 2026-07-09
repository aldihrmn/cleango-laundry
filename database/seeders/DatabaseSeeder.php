<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $order1 = Order::create([
            'user_id' => $user->id,
            'kode_order' => 'ORD-001',
            'tanggal_order' => '2026-07-09',
            'status' => 'Menunggu',
            'pickup_type' => 'Antar',
            'estimasi_selesai' => '2026-07-10',
            'total_harga' => 25000,
            'catatan' => 'Dummy order pertama',
        ]);

        $order2 = Order::create([
            'user_id' => $user->id,
            'kode_order' => 'ORD-002',
            'tanggal_order' => '2026-07-08',
            'status' => 'Selesai',
            'pickup_type' => 'Jemput',
            'estimasi_selesai' => '2026-07-09',
            'total_harga' => 40000,
            'catatan' => 'Dummy order kedua',
        ]);

        Payment::create([
            'order_id' => $order1->id,
            'metode' => 'Transfer',
            'jumlah' => 25000,
            'status_pembayaran' => 'Pending',
            'tanggal_bayar' => '2026-07-09 10:00:00',
        ]);

        Payment::create([
            'order_id' => $order2->id,
            'metode' => 'QRIS',
            'jumlah' => 40000,
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => '2026-07-08 15:30:00',
        ]);
    }
}
