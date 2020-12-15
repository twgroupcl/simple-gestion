<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Invoice;
use App\Observers\InvoiceObserver;
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
use Illuminate\Support\ServiceProvider;
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
        CommuneShippingMethod::observe(CommuneShippingMethodObserver::class);
    }
}
