<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_hotels')) {
            Schema::create('bravo_hotels', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->string('slug');
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
                $table->text('policy')->nullable();
                $table->smallInteger('star_rate')->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->string('check_in_time')->nullable();
                $table->string('check_out_time')->nullable();
                $table->smallInteger('allow_full_day')->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->string('status')->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->softDeletes(); // deleted_at
                $table->timestamps();  // created_at e updated_at
                $table->decimal('review_score', 2, 1)->nullable();
                $table->string('ical_import_url', 191)->nullable();
                $table->tinyInteger('enable_extra_price')->nullable();
                $table->text('extra_price')->nullable();
                $table->tinyInteger('enable_service_fee')->nullable();
                $table->text('service_fee')->nullable();
                $table->text('surrounding')->nullable();
                $table->text('badge_tags')->nullable();
                $table->bigInteger('author_id')->nullable();
                $table->integer('min_day_before_booking')->nullable();
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
        Schema::dropIfExists('bravo_hotels');
    }
}
