<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quotation_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('custom_price', 12, 4)->nullable();
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
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->unsignedBigInteger('additional_tax_id')->nullable();
            $table->decimal('additional_tax_amount', 12, 4)->nullable();
            $table->decimal('additional_tax_total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->boolean('is_custom')->default(false);
            $table->string('item_status')->nullable();
            $table->longText('json_value')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->timestamps();
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->foreign('quotation_id')->references('id')->on('quotations');
            $table->foreign('additional_tax_id')->references('id')->on('taxes');
            $table->foreign('currency_id')->references('id')->on('currencies');
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
        Schema::dropIfExists('quotations_items');
    }
}
