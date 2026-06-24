<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dapur_id')->constrained('dapur')->cascadeOnDelete();
            $table->string('nama');
            $table->integer('kuantiti')->default(1);
            $table->string('status')->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peralatan');
    }
};
