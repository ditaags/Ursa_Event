<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance', function (Blueprint $table) {
            $table->bigIncrements('id_finance');
            $table->decimal('bagian_super_admin', 12, 2);
            $table->decimal('bagian_admin', 12, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance');
    }
};