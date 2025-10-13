<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bravo_plans', function (Blueprint $table) {
            $table->text('snippet')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('bravo_plans', function (Blueprint $table) {
            $table->dropColumn('snippet');
        });
    }
};
