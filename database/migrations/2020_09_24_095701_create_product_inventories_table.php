<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_inventory_source_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty')->default(0);
            $table->timestamps();
        });

        Schema::table('product_inventories', function (Blueprint $table) {
            $table->foreign('product_inventory_source_id')->references('id')->on('product_inventory_sources');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_inventories');
    }
}
