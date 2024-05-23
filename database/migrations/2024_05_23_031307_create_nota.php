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
        Schema::create('nota', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota', 20);
            $table->string('nama_pengirim', 60);
            $table->string('alamat_pengirim', 200);
            $table->string('no_hp_pengirim', 15);
            $table->integer('total');
            $table->enum('pembayaran', ['Tunai', 'Kredit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};
