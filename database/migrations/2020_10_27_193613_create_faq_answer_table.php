<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFaqAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question')->nullable();
            $table->longText('answer')->nullable();
            $table->unsignedBigInteger('id_topic')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            
        });

        Schema::table('faq_answer', function (Blueprint $table) {
            $table->foreign('id_topic')->references('id')->on('faq_topic');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_answer');
    }
}
