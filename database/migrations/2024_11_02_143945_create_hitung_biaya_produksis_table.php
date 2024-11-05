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
        Schema::create('hitung_biaya_produksi', function (Blueprint $table) {
            $table->id();
            $table->decimal('persediaan_awal', 20, 2);
            $table->decimal('persediaan_akhir', 20, 2);
            $table->decimal('total_biaya_variabel', 20, 2);
            $table->decimal('biaya_produksi', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_biaya_produksi');
    }
};
