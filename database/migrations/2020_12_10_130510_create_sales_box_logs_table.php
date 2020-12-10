<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesBoxLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_box_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_box_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->string('event');
            $table->longText('json_value')->nullable();
            $table->timestamps();
        });

        Schema::table('sales_box_logs', function (Blueprint $table) {
            $table->foreign('sales_box_id')->references('id')->on('sales_boxes');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_box_logs');
    }
}
