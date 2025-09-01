<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoTourTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_tour_term')) {
            Schema::create('bravo_tour_term', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('term_id')->nullable();
                $table->integer('tour_id')->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamps(); // created_at e updated_at

                // Índices opcionais
                $table->index('term_id');
                $table->index('tour_id');
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
        Schema::dropIfExists('bravo_tour_term');
    }
}
