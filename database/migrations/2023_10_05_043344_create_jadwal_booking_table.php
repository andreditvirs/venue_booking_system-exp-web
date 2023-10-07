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
        Schema::create('jadwal_booking', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->float('harga', 8, 2)->default(0);
            $table->unsignedInteger('id_user_booking');
            $table->unsignedInteger('id_venue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_booking');
    }
};
