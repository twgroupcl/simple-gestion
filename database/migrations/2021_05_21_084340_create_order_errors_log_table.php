<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderErrorsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_errors_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->longText('order_json');
            $table->longText('api_response')->nullable();
            $table->string('error_message');
            $table->longText('json_value')->nullable();
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
        Schema::dropIfExists('order_errors_log');
    }
}
