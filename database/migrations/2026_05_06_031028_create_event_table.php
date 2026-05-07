<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('id_event'); // primary key custom
            $table->string('nama_event');
            $table->date('tanggal');
            $table->string('foto')->nullable();
            $table->text('deskripsi');
            $table->time('jam');
            $table->string('status')->default('aktif'); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
