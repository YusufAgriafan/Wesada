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
        Schema::create('hitung_perkiraan_penjualan', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga_jual', 20, 2);
            $table->integer('jumlah_produk');
            $table->decimal('perkiraan_penjualan', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_perkiraan_penjualan');
    }
};
