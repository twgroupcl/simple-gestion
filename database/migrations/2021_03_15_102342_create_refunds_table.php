<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('invoice_id')->constrained()->nullable();
            $table->integer('items_count')->nullable();
            $table->integer('items_qty')->nullable();
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('discount_amount', 12, 4)->nullable();
            $table->decimal('discount_percent', 12, 4)->nullable();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('shipping_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->foreignId('currency_id')->constrained();
            $table->longText('json_value')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('company_id')->constrained();
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
        Schema::dropIfExists('refunds');
    }
}
