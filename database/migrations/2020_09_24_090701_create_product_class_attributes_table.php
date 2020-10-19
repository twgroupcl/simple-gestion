<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClassAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_class_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_class_id');
            $table->longText('json_attributes')->nullable();
            $table->longText('json_options')->nullable();
            $table->longText('validations')->nullable();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_configurable')->default(false);
            $table->timestamps();
        });

        Schema::table('product_class_attributes', function (Blueprint $table) {
            $table->foreign('product_class_id')->references('id')->on('product_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_class_attributes');
    }
}
