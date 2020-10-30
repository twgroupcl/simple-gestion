<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('uid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable()->comment('Company name or razon social');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_number')->nullable();
            $table->string('receiver_name')->nullable();
            $table->longText('shipping_details')->nullable();
            $table->string('address_office')->nullable();
            $table->unsignedBigInteger('address_commune_id')->nullable();
            $table->boolean('is_company')->default(false);
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_percent', 12, 4)->nullable();
            $table->decimal('discount_amount', 12, 4)->nullable();
            $table->boolean('is_gift')->default(false);
            $table->integer('items_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('shipping_total', 12, 4)->nullable();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->string('checkout_method')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->string('session_id')->nullable()->comment('save the session id that generated this cart');
            $table->boolean('is_active')->default(false);
            $table->date('conversion_time')->nullable();
            $table->date('expire_time')->nullable();
            $table->longText('json_value')->nullable();
            $table->longText('invoice_value')->nullable()->comment('data invoice');
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('address_commune_id')->references('id')->on('communes');
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
        Schema::dropIfExists('carts');
    }
}
