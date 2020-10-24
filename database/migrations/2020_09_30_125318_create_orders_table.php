<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('uid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->boolean('is_company')->default(false);
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_percent', 12, 4)->nullable();
            $table->decimal('discount_amount', 12, 4)->nullable();
            $table->boolean('is_gift')->default(false);
            $table->integer('items_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('shipping_total', 12, 4)->nullable();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->string('order_status')->nullable();
            $table->string('checkout_method')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            $table->longText('order_items')->nullable();

            $table->unsignedBigInteger('company_id');

            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unique(['company_id', 'uid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
