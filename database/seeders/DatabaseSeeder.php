<?php

namespace Database\Seeders;

use App\Models\LaundryStatusLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Service;
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
        $this->call(RoleSeeder::class);
        $this->call(ServiceSeeder::class);

        $serviceReguler = Service::where('nama_layanan', 'Reguler')->first();
        $serviceExpress = Service::where('nama_layanan', 'Express')->first();

        // ADMIN
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@cleango.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        // CUSTOMER
        $customer = User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@cleango.com',
            'password' => bcrypt('password'),
        ]);

        $customer->assignRole('customer');

        // ORDER CUSTOMER
        $order1Berat = 3;
        $order1Total = $serviceReguler->harga_per_kg * $order1Berat;

        $order1 = Order::create([
            'user_id' => $customer->id,
            'kode_order' => 'ORD-001',
            'tanggal_order' => '2026-07-09',
            'status' => 'Menunggu',
            'pickup_type' => 'Antar',
            'estimasi_selesai' => '2026-07-10',
            'total_harga' => $order1Total,
            'catatan' => 'Dummy order pertama',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'service_id' => $serviceReguler->id,
            'berat' => $order1Berat,
            'harga' => $serviceReguler->harga_per_kg,
            'subtotal' => $order1Total,
        ]);

        LaundryStatusLog::create([
            'order_id' => $order1->id,
            'status' => 'Menunggu',
            'keterangan' => 'Order diterima',
        ]);

        $order2Berat = 3;
        $order2Total = $serviceExpress->harga_per_kg * $order2Berat;

        $order2 = Order::create([
            'user_id' => $customer->id,
            'kode_order' => 'ORD-002',
            'tanggal_order' => '2026-07-08',
            'status' => 'Selesai',
            'pickup_type' => 'Jemput',
            'estimasi_selesai' => '2026-07-09',
            'total_harga' => $order2Total,
            'catatan' => 'Dummy order kedua',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'service_id' => $serviceExpress->id,
            'berat' => $order2Berat,
            'harga' => $serviceExpress->harga_per_kg,
            'subtotal' => $order2Total,
        ]);

        LaundryStatusLog::create([
            'order_id' => $order2->id,
            'status' => 'Menunggu',
            'keterangan' => 'Order diterima',
        ]);

        LaundryStatusLog::create([
            'order_id' => $order2->id,
            'status' => 'Selesai',
            'keterangan' => 'Order selesai dikerjakan',
        ]);

        Payment::create([
            'order_id' => $order1->id,
            'metode' => 'QRIS',
            'jumlah' => $order1Total,
            'status_pembayaran' => 'Pending',
            'tanggal_bayar' => null,
        ]);

        Payment::create([
            'order_id' => $order2->id,
            'metode' => 'QRIS',
            'jumlah' => $order2Total,
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => '2026-07-08 15:30:00',
        ]);
    }
}
