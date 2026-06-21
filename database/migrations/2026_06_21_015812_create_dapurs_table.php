<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dapurs', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('nama_dapur');
            $table->string('status')->default('tersedia');
            $table->integer('max_orang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dapurs');
    }
};
