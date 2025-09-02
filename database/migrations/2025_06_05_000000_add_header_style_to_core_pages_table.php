<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeaderStyleToCorePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('core_pages') && !Schema::hasColumn('core_pages', 'header_style')) {
            Schema::table('core_pages', function (Blueprint $table) {
                $table->string('header_style', 255)->nullable()->after('updated_at');
                // Substitua 'some_column' pelo nome da coluna depois da qual você quer adicionar 'header_style'
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
        if (Schema::hasTable('core_pages') && Schema::hasColumn('core_pages', 'header_style')) {
            Schema::table('core_pages', function (Blueprint $table) {
                $table->dropColumn('header_style');
            });
        }
    }
}
