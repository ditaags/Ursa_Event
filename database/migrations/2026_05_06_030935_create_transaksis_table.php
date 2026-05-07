<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi'); // primary key custom
            $table->string('bukti_bayar')->nullable(); // simpan path foto
            $table->date('tanggal');
            $table->time('waktu');
            $table->decimal('sub_total', 12, 2); // untuk nominal uang
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};