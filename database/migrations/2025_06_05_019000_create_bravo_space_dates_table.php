<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoSpaceDatesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('bravo_space_dates')) {
            Schema::create('bravo_space_dates', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('target_id')->nullable();
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->tinyInteger('max_guests')->nullable();
                $table->tinyInteger('active')->default(0);
                $table->text('note_to_customer')->nullable();
                $table->text('note_to_admin')->nullable();
                $table->tinyInteger('is_instant')->default(0);
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->timestamps(); // created_at e updated_at
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('bravo_space_dates');
    }
}
