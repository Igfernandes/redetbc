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
        if (!Schema::hasTable('bravo_tour_category_translations')) {
            Schema::create('bravo_tour_category_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('origin_id')->nullable();
                $table->string('locale', 10)->nullable();
                $table->string('name', 255)->nullable();
                $table->text('content')->nullable();
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->timestamps();

                $table->unique(['origin_id', 'locale'], 'bravo_tour_category_translations_origin_id_locale_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bravo_tour_category_translations');
    }
};
