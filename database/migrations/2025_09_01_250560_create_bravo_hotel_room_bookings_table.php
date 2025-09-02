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
        Schema::create('bravo_hotel_room_bookings', function (Blueprint $table) {
            $table->id(); // bigint UNSIGNED AUTO_INCREMENT
            $table->bigInteger('room_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('booking_id')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->smallInteger('number')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
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
        Schema::dropIfExists('bravo_hotel_room_bookings');
    }
};
