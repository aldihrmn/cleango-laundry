<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Service::create([
            'nama_layanan' => 'Reguler',
            'jenis_layanan' => 'Reguler',
            'harga_per_kg' => 7000,
            'estimasi_hari' => 3,
            'deskripsi' => 'Layanan cuci reguler dengan estimasi 3 hari.',
            'is_active' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Express',
            'jenis_layanan' => 'Express',
            'harga_per_kg' => 12000,
            'estimasi_hari' => 1,
            'deskripsi' => 'Layanan cuci express dengan estimasi 1 hari.',
            'is_active' => true,
        ]);

        Service::create([
            'nama_layanan' => 'Kilat',
            'jenis_layanan' => 'Kilat',
            'harga_per_kg' => 18000,
            'estimasi_hari' => 1,
            'deskripsi' => 'Layanan cuci kilat dengan estimasi 1 hari.',
            'is_active' => true,
        ]);
    }
}
