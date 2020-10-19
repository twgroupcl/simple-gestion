<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('product_brands', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
