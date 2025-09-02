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
        Schema::table('core_news_category', function (Blueprint $table) {
            $table->bigInteger('origin_id')->nullable()->after('updated_at');
            $table->string('lang', 10)->nullable()->collation('utf8mb4_unicode_ci')->after('origin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_news_category', function (Blueprint $table) {
            $table->dropColumn(['origin_id', 'lang']);
        });
    }
};
