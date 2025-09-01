<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('religion', ['CATHOLIC', 'EVANGELICAL', 'BOTH'])->nullable();
            $table->enum('sex', ['MASCULINE', 'FEMININE'])->nullable(); // ou 'gender', se preferir
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['religion', 'sex']);
        });
    }
};
