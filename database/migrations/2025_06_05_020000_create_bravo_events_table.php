<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_events')) {
            Schema::create('bravo_events', function (Blueprint $table) {
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
                $table->text('faqs')->nullable();
                $table->text('ticket_types')->nullable();
                $table->integer('duration')->nullable();
                $table->string('start_time', 191)->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->tinyInteger('is_instant')->default(0);
                $table->tinyInteger('enable_extra_price')->nullable();
                $table->text('extra_price')->nullable();
                $table->decimal('review_score', 2, 1)->nullable();
                $table->string('ical_import_url', 191)->nullable();
                $table->string('status', 50)->nullable();
                $table->tinyInteger('default_state')->default(1);
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps(); // created_at e updated_at
                $table->tinyInteger('enable_service_fee')->nullable();
                $table->text('service_fee')->nullable();
                $table->text('surrounding')->nullable();
                $table->string('end_time')->nullable();
                $table->string('duration_unit')->nullable();
                $table->bigInteger('author_id')->nullable();
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
        Schema::dropIfExists('bravo_events');
    }
}
