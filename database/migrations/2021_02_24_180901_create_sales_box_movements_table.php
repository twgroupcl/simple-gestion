<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesBoxMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_box_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_box_id');
            $table->unsignedBigInteger('movement_type_id');
            $table->decimal('amount', 12, 4)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps();
        });
        Schema::table('sales_box_movements', function (Blueprint $table) {
            $table->foreign('sales_box_id')->references('id')->on('sales_boxes');
            $table->foreign('movement_type_id')->references('id')->on('movement_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_box_movements');
    }
}
