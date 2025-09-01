<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_hotel_rooms')) {
            Schema::create('bravo_hotel_rooms', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->integer('image_id')->nullable();
                $table->string('gallery')->nullable();
                $table->string('video')->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->bigInteger('parent_id')->nullable();
                $table->smallInteger('number')->nullable();
                $table->tinyInteger('beds')->nullable();
                $table->integer('size')->nullable();
                $table->tinyInteger('adults')->nullable();
                $table->tinyInteger('children')->nullable();
                $table->string('status', 50)->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps(); // created_at e updated_at
                $table->string('ical_import_url', 191)->nullable();
                $table->integer('min_day_stays')->nullable();
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
        Schema::dropIfExists('bravo_hotel_rooms');
    }
}
