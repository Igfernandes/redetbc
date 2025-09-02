<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_boats')) {
            Schema::create('bravo_boats', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->string('slug')->charset('utf8')->collation('utf8_general_ci');
                $table->text('content')->nullable();
                $table->integer('image_id')->nullable();
                $table->integer('banner_image_id')->nullable();
                $table->integer('location_id')->nullable();
                $table->string('address')->nullable();
                $table->string('map_lat', 20)->nullable();
                $table->string('map_lng', 20)->nullable();
                $table->integer('map_zoom')->nullable();
                $table->tinyInteger('is_featured')->nullable();
                $table->string('gallery')->nullable();
                $table->string('video')->nullable();
                $table->text('faqs')->nullable();
                $table->tinyInteger('number')->nullable();
                $table->decimal('price_per_hour', 12, 2)->nullable();
                $table->decimal('price_per_day', 12, 2)->nullable();
                $table->decimal('min_price', 12, 2)->nullable();
                $table->tinyInteger('enable_extra_price')->nullable();
                $table->text('extra_price')->nullable();
                $table->integer('max_guest')->nullable();
                $table->integer('cabin')->nullable();
                $table->string('length')->nullable();
                $table->string('speed')->nullable();
                $table->text('specs')->nullable();
                $table->text('cancel_policy')->nullable();
                $table->text('terms_information')->nullable();
                $table->decimal('review_score', 2, 1)->nullable();
                $table->string('status', 50)->nullable();
                $table->tinyInteger('default_state')->default(1);
                $table->tinyInteger('enable_service_fee')->nullable();
                $table->text('service_fee')->nullable();
                $table->integer('min_day_before_booking')->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->bigInteger('author_id')->nullable();
                $table->text('include')->nullable();
                $table->text('exclude')->nullable();
                $table->string('start_time_booking', 191)->nullable();
                $table->string('end_time_booking', 191)->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('bravo_boats');
    }
}
