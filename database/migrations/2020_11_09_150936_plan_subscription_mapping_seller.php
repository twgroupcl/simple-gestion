<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanSubscriptionMappingSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_subscription_seller_mapping', function (Blueprint $table) {
            $table->unsignedInteger('plan_subscription_id');
            $table->unsignedBigInteger('user_id');
            $table->string('key')->nullable();
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('plan_subscription_seller_mapping', function (Blueprint $table) {
            $table->foreign('plan_subscription_id')->references('id')->on('plan_subscriptions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_subscription_seller_mapping');
    }
}
