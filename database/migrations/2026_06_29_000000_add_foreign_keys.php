<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peralatan', function (Blueprint $table) {
            $table->foreign('dapur_id')->references('id')->on('dapur')->cascadeOnDelete();
        });

        Schema::table('bahan', function (Blueprint $table) {
            $table->foreign('dapur_id')->references('id')->on('dapur')->cascadeOnDelete();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('bookings')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('peralatan', fn (Blueprint $t) => $t->dropForeign(['dapur_id']));
        Schema::table('bahan', fn (Blueprint $t) => $t->dropForeign(['dapur_id']));
        Schema::table('reviews', fn (Blueprint $t) => $t->dropForeign(['booking_id']));
    }
};
