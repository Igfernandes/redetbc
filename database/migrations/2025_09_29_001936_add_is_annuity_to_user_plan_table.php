<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bravo_user_plan', function (Blueprint $table) {
            // Adiciona a coluna is_annuity como boolean, default 0, após 'status'
            $table->boolean('is_annuity')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('user_plan', function (Blueprint $table) {
            $table->dropColumn('is_annuity');
        });
    }
};
