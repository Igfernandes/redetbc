<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_tours')) {
            Schema::create('bravo_tours', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->string('slug', 255)->charset('utf8')->collation('utf8_general_ci');
                $table->text('content')->nullable();
                $table->integer('image_id')->nullable();
                $table->integer('banner_image_id')->nullable();
                $table->text('short_desc')->nullable();
                $table->integer('category_id')->nullable();
                $table->integer('location_id')->nullable();
                $table->string('address')->nullable();
                $table->string('map_lat', 20)->nullable();
                $table->string('map_lng', 20)->nullable();
                $table->integer('map_zoom')->nullable();
                $table->tinyInteger('is_featured')->nullable();
                $table->string('gallery')->nullable();
                $table->string('video')->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->integer('duration')->nullable();
                $table->integer('min_people')->nullable();
                $table->integer('max_people')->nullable();
                $table->text('faqs')->nullable();
                $table->string('status', 50)->nullable();
                $table->dateTime('publish_date')->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->bigInteger('origin_id')->nullable();
                $table->string('lang', 10)->nullable();
                $table->timestamps(); // created_at e updated_at
                $table->tinyInteger('default_state')->default(1);
                $table->tinyInteger('enable_fixed_date')->default(0);
                $table->dateTime('start_date')->nullable();
                $table->dateTime('end_date')->nullable();
                $table->dateTime('last_booking_date')->nullable();
                $table->text('include')->nullable();
                $table->text('exclude')->nullable();
                $table->text('itinerary')->nullable();
                $table->decimal('review_score', 2, 1)->nullable();
                $table->string('ical_import_url', 191)->nullable();
                $table->tinyInteger('enable_service_fee')->nullable();
                $table->text('service_fee')->nullable();
                $table->text('surrounding')->nullable();
                $table->string('date_form_to', 191)->nullable();
                $table->string('min_age', 191)->nullable();
                $table->string('pickup', 191)->nullable();
                $table->tinyInteger('wifi_available')->nullable();
                $table->bigInteger('author_id')->nullable();
                $table->integer('min_day_before_booking')->nullable();

                // Índices opcionais
                $table->index('category_id');
                $table->index('location_id');
                $table->index('slug');
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
        Schema::dropIfExists('bravo_tours');
    }
}
