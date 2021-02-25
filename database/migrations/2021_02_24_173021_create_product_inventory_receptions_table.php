<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoryReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventory_receptions', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->longText('products_data');
            $table->string('type_operation');
            $table->string('excel_path')->nullable();
            $table->foreignId('company_id')->constrained();
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
        Schema::dropIfExists('product_inventory_receptions');
    }
}
