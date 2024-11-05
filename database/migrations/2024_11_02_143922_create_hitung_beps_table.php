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
        Schema::create('hitung_bep', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_biaya_tetap', 20, 2);
            $table->decimal('harga_jual', 20, 2);
            $table->decimal('biaya_variabel_unit', 20, 2);
            $table->decimal('bep', 20, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_bep');
    }
};
