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
        Schema::table('bravo_attrs', function (Blueprint $table) {
            $table->integer('min_day_before_booking')->nullable();
            $table->integer('min_day_stays')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bravo_attrs', function (Blueprint $table) {
            $table->dropColumn([
                'min_day_before_booking',
                'min_day_stays',
            ]);
        });
    }
};
