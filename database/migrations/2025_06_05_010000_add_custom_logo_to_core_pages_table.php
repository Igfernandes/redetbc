<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomLogoToCorePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('core_pages') && !Schema::hasColumn('core_pages', 'custom_logo')) {
            Schema::table('core_pages', function (Blueprint $table) {
                $table->integer('custom_logo')->nullable()->after('header_style'); 
                // 'after' é opcional, define a posição da coluna. Pode remover se quiser adicionar no final
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
        if (Schema::hasTable('core_pages') && Schema::hasColumn('core_pages', 'custom_logo')) {
            Schema::table('core_pages', function (Blueprint $table) {
                $table->dropColumn('custom_logo');
            });
        }
    }
}
