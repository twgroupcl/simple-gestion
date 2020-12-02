<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanSubscriptionPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_subscription_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_subscription_id');
            $table->string('method');
            $table->string('method_title');
            $table->longText('json_out')->nullable();
            $table->date('date_out')->nullable();
            $table->longText('json_in')->nullable();
            $table->date('date_in')->nullable();
            $table->timestamps();
        });

        Schema::table('plan_subscription_payment', function (Blueprint $table) {
            $table->foreign('plan_subscription_id')->references('id')->on('plan_subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_subscription_payment');

    }
}
