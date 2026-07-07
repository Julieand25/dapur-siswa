<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location_code');
            $table->string('kitchen_name');
            $table->string('status')->default('pending');
            $table->integer('bilangan_hidangan')->default(1);
            $table->text('rejection_reason')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
