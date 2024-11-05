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
        Schema::create('hitung_hpp', function (Blueprint $table) {
            $table->id();
            $table->decimal('persediaan_awal', 20, 2);
            $table->decimal('persediaan_akhir', 20, 2);
            $table->decimal('total_biaya_variabel', 20, 2);
            $table->decimal('hpp', 20, 2);
            $table->integer('jumlah_produk');
            $table->decimal('hpp_unit', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_hpp');
    }
};
