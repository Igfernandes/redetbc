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
        if (!Schema::hasTable('bravo_hotel_translations')) {
            Schema::create('bravo_hotel_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('origin_id');
                $table->string('locale', 191);
                $table->string('title', 255)->nullable();
                $table->text('content')->nullable();
                $table->string('address', 255)->nullable();
                $table->text('policy')->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
                $table->text('surrounding')->nullable();
                $table->text('badge_tags')->nullable();

                $table->index('locale', 'bravo_hotel_translations_locale_index');
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
        Schema::dropIfExists('bravo_hotel_translations');
    }
};
