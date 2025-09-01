<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('core_role_permissions')) {
            Schema::create('core_role_permissions', function (Blueprint $table) {
                $table->increments('id'); // auto-increment
                $table->unsignedInteger('role_id')->nullable();
                $table->string('permission', 191)->nullable();
                $table->integer('create_user')->nullable();
                $table->integer('update_user')->nullable();
                $table->timestamps(); // created_at e updated_at

                $table->index('role_id'); // índice para role_id
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
        Schema::dropIfExists('core_role_permissions');
    }
}
