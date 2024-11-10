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
        Schema::create('hitung_laba_kotor', function (Blueprint $table) {
            $table->id();
            $table->decimal('perkiraan_penjualan', 20, 2);
            $table->decimal('hpp', 20, 2);
            $table->decimal('laba_kotor', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_laba_kotor');
    }
};