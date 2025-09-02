<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBravoSeatTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bravo_seat_type')) {
            Schema::create('bravo_seat_type', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code', 191);
                $table->string('name', 191)->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->bigInteger('author_id')->nullable();
                $table->timestamps(); // created_at e updated_at
                $table->softDeletes(); // deleted_at
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
        Schema::dropIfExists('bravo_seat_type');
    }
}
