<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_requests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('is_approved')->default(0);
            $table->longText('respond_message')->nullable();
            $table->longText('notes')->nullable();
            
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('time_block_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('company_id');

            $table->longText('json_value')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('reservation_requests', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('time_block_id')->references('id')->on('time_blocks');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('reservation_requests');
    }
}
