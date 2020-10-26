<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('sku');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('custom_price', 12, 4)->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_percent', 12, 4)->nullable();
            $table->decimal('discount_amount', 12, 4)->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('width', 12, 4)->nullable();
            $table->decimal('height', 12, 4)->nullable();
            $table->decimal('depth', 12, 4)->nullable();
            $table->decimal('weight', 12, 4)->nullable();
            $table->decimal('weight_total', 12, 4)->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('shipping_total', 12, 4)->nullable();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->longText('json_value')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->integer('shipping_status')->default(1);
            $table->timestamps();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('parent_id')->references('id')->on('products');
            $table->foreign('payment_id')->references('id')->on('payment_methods');
            $table->foreign('shipping_id')->references('id')->on('shipping_methods');
            $table->foreign('seller_id')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}