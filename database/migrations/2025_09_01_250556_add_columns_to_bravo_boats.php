<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bravo_boats', function (Blueprint $table) {
            $table->text('include')->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('exclude')->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('start_time_booking', 191)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('end_time_booking', 191)->nullable()->collation('utf8mb4_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $table->dropColumn(['include', 'exclude', 'start_time_booking', 'end_time_booking']);
        });
    }
};
