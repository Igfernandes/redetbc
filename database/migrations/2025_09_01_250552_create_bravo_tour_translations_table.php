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
        if (!Schema::hasTable('bravo_tour_translations')) {
            Schema::create('bravo_tour_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('origin_id')->nullable();
                $table->string('locale', 10)->nullable();
                $table->string('title', 255)->nullable();
                $table->string('slug', 255)->collation('utf8_general_ci');
                $table->text('content')->nullable();
                $table->text('short_desc')->nullable();
                $table->string('address', 255)->nullable();
                $table->text('faqs')->nullable();
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->timestamps();
                $table->text('include')->nullable();
                $table->text('exclude')->nullable();
                $table->text('itinerary')->nullable();
                $table->text('surrounding')->nullable();

                // índices
                $table->unique(['origin_id', 'locale'], 'bravo_tour_translations_origin_id_locale_unique');
                $table->index('slug', 'bravo_tour_translations_slug_index');
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
        Schema::dropIfExists('bravo_tour_translations');
    }
};
