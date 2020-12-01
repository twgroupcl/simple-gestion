<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Quotation;
use App\Models\ProductClass;
use App\Observers\OrderObserver;
use App\Observers\SellerObserver;
use App\Observers\ProductObserver;
use App\Observers\CustomerObserver;
use App\Observers\OrderItemObserver;
use App\Observers\QuotationObserver;
use App\Models\ProductClassAttribute;
use App\Observers\ProductClassObserver;
use Illuminate\Support\ServiceProvider;
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
        ProductClass::observe(ProductClassObserver::class);
        ProductClassAttribute::observe(ProductClassAttributeObserver::class);
        Product::observe(ProductObserver::class);
        Quotation::observe(QuotationObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);

    }
}
