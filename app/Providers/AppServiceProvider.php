<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payments;
use App\Observers\InvoiceObserver;
use App\Observers\PaymentsObserver;
use App\Models\OrderItem;
use App\Models\Quotation;
use App\Observers\OrderObserver;
use App\Observers\SellerObserver;
use App\Observers\ProductObserver;
use App\Observers\CustomerObserver;
use App\Observers\OrderItemObserver;
use App\Observers\QuotationObserver;
use App\Models\CommuneShippingMethod;
use App\Models\ProductClassAttribute;
use App\Models\SalesBox;
use Illuminate\Support\ServiceProvider;
use App\Observers\CommuneShippingMethodObserver;
use App\Observers\ProductClassAttributeObserver;
use App\Payment;
use App\Observers\SalesBoxObserver;

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
    }
}
