<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->date('quotation_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('uid');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->boolean('is_company')->default(false);
            $table->longText('preface')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('include_payment_data')->default(true);
            $table->string('tax_type');
            $table->boolean('email_sent')->default(false);
            $table->decimal('discount_percent', 16, 4)->nullable();
            $table->decimal('discount_amount', 16, 4)->nullable();
            $table->unsignedMediumInteger('items_count')->default(0);
            $table->unsignedMediumInteger('items_qty')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->boolean('has_discount_per_item')->default(false);
            $table->boolean('has_tax_per_item')->default(false);
            $table->string('unique_hash')->nullable()->index()->unique();
            $table->decimal('discount_total', 16, 4)->nullable();
            $table->decimal('sub_total', 16, 4)->nullable();
            $table->decimal('net', 16, 4)->nullable();
            $table->decimal('total', 16, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 16, 4)->nullable();
            $table->decimal('tax_total', 16, 4)->nullable();
            $table->unsignedBigInteger('tax_specific')->nullable();
            $table->string('quotation_status')->nullable();
            $table->longText('items_data')->nullable();
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            // $table->unsignedBigInteger('quotation_template_id')->nullable();
            $table->unsignedBigInteger('business_activity_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('currency_id')->references('id')->on('currencies');
            // $table->foreign('quotation_template_id')->references('id')->on('quotation_templates');
            $table->foreign('business_activity_id')->references('id')->on('business_activities');
            $table->foreign('address_id')->references('id')->on('customer_addresses');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unique(['branch_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
