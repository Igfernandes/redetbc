<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->decimal('total_before_discount', 10, 2)->default(0)->after('total_before_fees');
        });
    }

    public function down(): void
    {
        Schema::table('bravo_bookings', function (Blueprint $table) {
            $table->dropColumn('total_before_discount');
        });
    }
};
