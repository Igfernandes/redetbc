<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBravoLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('bravo_locations')) {
            Schema::table('bravo_locations', function (Blueprint $table) {
                if (!Schema::hasColumn('bravo_locations', 'banner_image_id')) {
                    $table->integer('banner_image_id')->nullable()->after('id');
                }
                if (!Schema::hasColumn('bravo_locations', 'trip_ideas')) {
                    $table->text('trip_ideas')->nullable()->after('banner_image_id');
                }
                if (!Schema::hasColumn('bravo_locations', 'gallery')) {
                    $table->string('gallery', 191)->nullable()->after('trip_ideas');
                }
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
        if (Schema::hasTable('bravo_locations')) {
            Schema::table('bravo_locations', function (Blueprint $table) {
                if (Schema::hasColumn('bravo_locations', 'banner_image_id')) {
                    $table->dropColumn('banner_image_id');
                }
                if (Schema::hasColumn('bravo_locations', 'trip_ideas')) {
                    $table->dropColumn('trip_ideas');
                }
                if (Schema::hasColumn('bravo_locations', 'gallery')) {
                    $table->dropColumn('gallery');
                }
            });
        }
    }
}
