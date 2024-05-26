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
            $table->foreignId('id_pengiriman')->constrained(
                table: 'pengiriman', indexName: 'detail_pengiriman_id_pengiriman_foreign'
            );
            $table->dateTime('tanggal_dikirim');
            $table->string('nama_penerima', 60);
            $table->string('no_hp_penerima', 20)->nullable();
            $table->string('deskripsi', 200);
            $table->integer('berat');
            $table->integer('koli');
            $table->string('instruksi_khusus', 200)->nullable();
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
