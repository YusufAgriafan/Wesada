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
        Schema::create('custom_nav_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string( 'url');
            $table->unsignedBigInteger('usaha_id')->nullable(); 
            $table->foreign('usaha_id')->references('id')->on('custom_nama_usahas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_nav_links');
    }
};