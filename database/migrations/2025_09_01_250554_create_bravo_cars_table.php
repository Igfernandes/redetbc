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
        if (!Schema::hasTable('bravo_cars')) {
            Schema::create('bravo_cars', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title', 255)->nullable();
                $table->string('slug', 255)->charset('utf8')->collation('utf8_general_ci');
                $table->text('content')->nullable();
                $table->integer('image_id')->nullable();
                $table->integer('banner_image_id')->nullable();
                $table->integer('location_id')->nullable();
                $table->string('address', 255)->nullable();
                $table->string('map_lat', 20)->nullable();
                $table->string('map_lng', 20)->nullable();
                $table->integer('map_zoom')->nullable();
                $table->tinyInteger('is_featured')->nullable();
                $table->string('gallery', 255)->nullable();
                $table->string('video', 255)->nullable();
                $table->text('faqs')->nullable();
                $table->tinyInteger('number')->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->tinyInteger('is_instant')->default(0);
                $table->tinyInteger('enable_extra_price')->nullable();
                $table->text('extra_price')->nullable();
                $table->text('discount_by_days')->nullable();
                $table->tinyInteger('passenger')->default(0);
                $table->string('gear', 191)->default('0');
                $table->tinyInteger('baggage')->default(0);
                $table->tinyInteger('door')->default(0);
                $table->string('status', 50)->nullable();
                $table->tinyInteger('default_state')->default(1);
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->decimal('review_score', 2, 1)->nullable();
                $table->tinyInteger('enable_service_fee')->nullable();
                $table->text('service_fee')->nullable();
                $table->text('specifications')->nullable();
                $table->bigInteger('author_id')->nullable();
                $table->string('ical_import_url', 191)->nullable();
                $table->integer('min_day_before_booking')->nullable();
                $table->integer('min_day_stays')->nullable();

                // Índice para slug
                $table->index('slug', 'bravo_cars_slug_index');
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
        Schema::dropIfExists('bravo_cars');
    }
};
