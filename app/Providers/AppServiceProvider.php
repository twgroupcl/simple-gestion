<?php

namespace App\Providers;

use App\Payment;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payments;
use App\Models\SalesBox;
use App\Models\OrderItem;
use App\Models\PriceList;
use App\Models\Quotation;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Observers\OrderObserver;
use App\Models\AccountingAccount;
use App\Observers\SellerObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProductObserver;
use App\Observers\CustomerObserver;
use App\Observers\PaymentsObserver;
use App\Observers\SalesBoxObserver;
use App\Observers\OrderItemObserver;
use App\Observers\PriceListObserver;
use App\Observers\QuotationObserver;
use App\Models\CommuneShippingMethod;
use App\Models\ProductClassAttribute;
use App\Observers\BankAccountObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\TransactionTypeObserver;
use App\Observers\AccountingAccountObserver;
use App\Observers\CommuneShippingMethodObserver;
use App\Observers\ProductClassAttributeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path('Helpers').'/*.php') as $file) {
            require_once $file;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
        Seller::observe(SellerObserver::class);
        Customer::observe(CustomerObserver::class);
        ProductClassAttribute::observe(ProductClassAttributeObserver::class);
        Product::observe(ProductObserver::class);
        Quotation::observe(QuotationObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Payments::observe(PaymentsObserver::class);
        CommuneShippingMethod::observe(CommuneShippingMethodObserver::class);
        SalesBox::observe(SalesBoxObserver::class);
        Transaction::observe(TransactionObserver::class);
        TransactionType::observe(TransactionTypeObserver::class);
        AccountingAccount::observe(AccountingAccountObserver::class);
        BankAccount::observe(BankAccountObserver::class);
        PriceList::observe(PriceListObserver::class);
    }
}
