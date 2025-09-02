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
        if (!Schema::hasTable('bravo_event_translations')) {
            Schema::create('bravo_event_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('origin_id');
                $table->string('locale', 191);
                $table->string('title', 255)->nullable();
                $table->text('content')->nullable();
                $table->text('faqs')->nullable();
                $table->string('address', 255)->nullable();
                $table->bigInteger('create_user')->nullable();
                $table->bigInteger('update_user')->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->text('surrounding')->nullable();

                // Índice
                $table->index('locale', 'bravo_event_translations_locale_index');
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
        Schema::dropIfExists('bravo_event_translations');
    }
};
