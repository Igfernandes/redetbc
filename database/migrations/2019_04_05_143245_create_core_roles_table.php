<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('core_roles')) {
            Schema::create('core_roles', function (Blueprint $table) {
                $table->increments('id'); // auto-increment
                $table->string('name', 191)->nullable();
                $table->string('code', 50)->nullable();
                $table->decimal('commission', 8, 2)->nullable();
                $table->string('commission_type', 40)->default('default');
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->string('status', 30)->nullable();
                $table->timestamps(); // created_at e updated_at
                
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
        Schema::dropIfExists('core_roles');
    }
}
