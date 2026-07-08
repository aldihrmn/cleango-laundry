<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('kode_order')->unique();
            $table->date('tanggal_order');
            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Dicuci',
                'Dikeringkan',
                'Disetrika',
                'Selesai',
                'Diambil'
            ]);

            $table->enum('pickup_type', [
                'Antar',
                'Jemput'
            ]);

            $table->date('estimasi_selesai');

            $table->decimal('total_harga', 10, 2)->default(0);

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
