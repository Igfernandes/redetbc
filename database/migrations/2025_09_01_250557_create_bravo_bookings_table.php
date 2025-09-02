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
        Schema::create('bravo_bookings', function (Blueprint $table) {
            $table->id(); // bigint UNSIGNED AUTO_INCREMENT
            $table->string('code', 64)->nullable()->collation('utf8mb4_unicode_ci');
            $table->integer('vendor_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('gateway', 50)->nullable()->collation('utf8mb4_unicode_ci');
            $table->integer('object_id')->nullable();
            $table->string('object_model', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->integer('total_guests')->nullable();
            $table->string('currency', 5)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('status', 30)->nullable()->collation('utf8mb4_unicode_ci');
            $table->decimal('deposit', 10, 2)->nullable();
            $table->string('deposit_type', 30)->nullable()->collation('utf8mb4_unicode_ci');
            $table->decimal('commission', 10, 2)->nullable();
            $table->string('commission_type', 150)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('email', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('first_name', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('last_name', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('phone', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('address', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('address2', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('city', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('state', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('zip_code', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('country', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->text('customer_notes')->nullable()->collation('utf8mb4_unicode_ci');
            $table->decimal('vendor_service_fee_amount', 8, 2)->nullable();
            $table->text('vendor_service_fee')->nullable()->collation('utf8mb4_unicode_ci');
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->softDeletes(); // deleted_at
            $table->timestamps();  // created_at e updated_at
            $table->text('buyer_fees')->nullable()->collation('utf8mb4_unicode_ci');
            $table->decimal('total_before_fees', 10, 2)->nullable();
            $table->tinyInteger('paid_vendor')->nullable();
            $table->bigInteger('object_child_id')->nullable();
            $table->smallInteger('number')->nullable();
            $table->decimal('paid', 10, 2)->nullable();
            $table->decimal('pay_now', 10, 2)->nullable();
            $table->double('wallet_credit_used')->nullable();
            $table->double('wallet_total_used')->nullable();
            $table->bigInteger('wallet_transaction_id')->nullable();
            $table->tinyInteger('is_refund_wallet')->nullable();
            $table->tinyInteger('is_paid')->nullable();
            $table->decimal('total_before_discount', 10, 2)->default(0.00);
            $table->decimal('coupon_amount', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bravo_bookings');
    }
};
