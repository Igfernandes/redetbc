<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_upgrade_request', function (Blueprint $table) {
            $table->string('type', 40)->nullable()->after('role_request');
        });
    }

    public function down(): void
    {
        Schema::table('user_upgrade_request', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
