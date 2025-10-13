<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bravo_user_plan', function (Blueprint $table) {
            $table->string('checkout_session')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('bravo_user_plan', function (Blueprint $table) {
            $table->dropColumn('checkout_session');
        });
    }
};
