<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahans', function (Blueprint $table) {
            $table->integer('low_stock_threshold')->default(3)->after('kuantiti');
        });
    }

    public function down(): void
    {
        Schema::table('bahans', function (Blueprint $table) {
            $table->dropColumn('low_stock_threshold');
        });
    }
};
