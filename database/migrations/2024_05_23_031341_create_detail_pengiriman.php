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
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengiriman', 20);
            $table->dateTime('tanggal_dikirim');
            $table->string('nama_penerima', 60);
            $table->string('no_hp_penerima', 15);
            $table->string('deskripsi', 200);
            $table->integer('berat');
            $table->integer('koli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengiriman');
    }
};
