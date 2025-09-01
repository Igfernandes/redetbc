<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoTourCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_tour_category')) {
            Schema::create('bravo_tour_category', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable();
                $table->text('content')->nullable();
                $table->string('slug')->nullable();
                $table->string('status', 50)->nullable();
                $table->unsignedInteger('_lft')->default(0);
                $table->unsignedInteger('_rgt')->default(0);
                $table->unsignedInteger('parent_id')->nullable();
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->bigInteger('origin_id')->nullable();
                $table->string('lang', 10)->nullable();
                $table->timestamps(); // created_at e updated_at

                // Índices opcionais
                $table->index('parent_id');
                $table->index('slug');
                $table->index('_lft');
                $table->index('_rgt');
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
        Schema::dropIfExists('bravo_tour_category');
    }
}
