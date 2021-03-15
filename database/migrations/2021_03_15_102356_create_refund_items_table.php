<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refund_id')->constrained();
            $table->string('sku');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('width', 12, 4)->nullable();
            $table->decimal('height', 12, 4)->nullable();
            $table->decimal('depth', 12, 4)->nullable();
            $table->decimal('weight', 12, 4)->nullable();
            $table->decimal('weight_total', 12, 4)->nullable();
            $table->integer('qty')->nullable();
            $table->integer('ind_exe')->default(0);
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('shipping_total', 12, 4)->nullable();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('additional_tax_id', 12, 4)->nullable();
            $table->decimal('additional_tax_amount', 12, 4)->nullable();
            $table->decimal('additional_tax_total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('product_id')->constrained()->nullable();
            $table->foreignId('seller_id')->constrained()->nullable();
            $table->longText('json_value')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_items');
    }
}
