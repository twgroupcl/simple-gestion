<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dte_code')->nullable();
            $table->string('title')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('invoice_type_id')->nullable();
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
            //$table->string('tax_type'); invoice_type_id
            $table->string('payment_method')->nullable()->comment('Method of payment by customer. Credit or debit Card - Cash - Transfer Bank');
            $table->unsignedInteger('way_to_payment')->nullable()->comment('Way to payment by customer. 1 Cash or Debit - 2 Credit');
            $table->unsignedBigInteger('bank_id')->nullable()->comment('payment bank');
            $table->unsignedBigInteger('bank_account_type_id')->nullable();
            $table->string('bank_number_account')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->decimal('discount_percent', 12, 4)->nullable();
            $table->decimal('discount_amount', 12, 4)->nullable();
            $table->integer('items_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->boolean('has_discount_per_item')->default(false);
            $table->boolean('has_tax_per_item')->default(false);
            $table->string('unique_hash')->nullable()->index()->unique();
            $table->decimal('discount_total', 12, 4)->nullable();
            $table->decimal('sub_total', 12, 4)->nullable();
            $table->decimal('net', 12, 4)->nullable();
            $table->decimal('total', 12, 4)->nullable();
            $table->decimal('tax_percent', 12, 4)->nullable();
            $table->decimal('tax_amount', 12, 4)->nullable();
            $table->decimal('tax_total', 12, 4)->nullable();
            $table->unsignedBigInteger('tax_specific')->nullable();
            $table->string('invoice_status')->nullable();
            $table->longText('items_data')->nullable();
            $table->longText('json_value')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('folio')->nullable();
            // $table->unsignedBigInteger('quotation_template_id')->nullable();
            $table->unsignedBigInteger('seller_business_activity_id')->nullable();
            $table->unsignedBigInteger('customer_business_activity_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            
            //@todo branch
            //$table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('currency_id')->references('id')->on('currencies');
            // $table->foreign('invoice_template_id')->references('id')->on('invoice_templates');
            $table->foreign('seller_business_activity_id')->references('id')->on('business_activities');
            $table->foreign('customer_business_activity_id')->references('id')->on('business_activities');
            $table->foreign('address_id')->references('id')->on('customer_addresses');
            $table->foreign('invoice_type_id')->references('id')->on('invoice_types');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('bank_account_type_id')->references('id')->on('bank_account_types');
            
            //$table->foreign('branch_id')->references('id')->on('branches');
            //$table->unique(['branch_id', 'dte_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
