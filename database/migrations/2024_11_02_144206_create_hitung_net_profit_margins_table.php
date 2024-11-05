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
        Schema::create('hitung_net_profit_margin', function (Blueprint $table) {
            $table->id();
            $table->decimal('laba_usaha', 20, 2);;
            $table->decimal('perkiraan_penjualan', 20, 2);
            $table->decimal('net_profit_margin', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_net_profit_margin');
    }
};
