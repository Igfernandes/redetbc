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
        Schema::table('users', function (Blueprint $table) {
            $table->string('payment_gateway', 30)->nullable()->collation('utf8mb4_unicode_ci')->after('remember_token');
            $table->integer('total_guests')->nullable()->after('payment_gateway');
            $table->string('locale', 10)->nullable()->collation('utf8mb4_unicode_ci')->after('total_guests');
            $table->tinyInteger('active_status')->default(0)->after('is_verified');
            $table->tinyInteger('dark_mode')->default(0)->after('active_status');
            $table->string('messenger_color', 191)->default('#2180f3')->collation('utf8mb4_unicode_ci')->after('dark_mode');
            $table->string('stripe_customer_id', 191)->nullable()->collation('utf8mb4_unicode_ci')->after('messenger_color');
            $table->decimal('total_before_fees', 10, 2)->nullable()->after('stripe_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'payment_gateway',
                'total_guests',
                'locale',
                'verify_submit_status',
                'active_status',
                'dark_mode',
                'messenger_color',
                'stripe_customer_id',
                'total_before_fees'
            ]);
        });
    }
};
