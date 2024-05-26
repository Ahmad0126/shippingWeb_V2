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
        Schema::create('histori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengiriman')->constrained(
                table: 'pengiriman', indexName: 'histori_id_pengiriman_foreign'
            );
            $table->dateTime('tanggal');
            $table->string('deskripsi', 200);
            $table->enum('status', ['registered','checkout','forwarded','received_sort','received_origin','received_warehouse','delivery','delivered']);
            $table->foreignId('id_user')->constrained(
                table: 'user', indexName: 'histori_id_user_foreign'
            );
            $table->foreignId('id_cabang')->constrained(
                table: 'cabang', indexName: 'histori_id_cabang_foreign'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori');
    }
};
