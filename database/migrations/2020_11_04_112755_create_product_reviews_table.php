<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('title');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
