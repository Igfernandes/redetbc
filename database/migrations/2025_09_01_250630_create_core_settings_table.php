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
        Schema::create('core_settings', function (Blueprint $table) {
            $table->id(); // bigint UNSIGNED AUTO_INCREMENT
            $table->string('name', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('group', 50)->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('val')->nullable()->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('autoload')->nullable();
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->string('lang', 10)->nullable()->collation('utf8mb4_unicode_ci');
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_settings');
    }
};
