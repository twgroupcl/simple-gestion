<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Customer;
use App\Observers\ProductObserver;
use App\Observers\CustomerObserver;
use App\Models\ProductClassAttribute;
use App\Models\Seller;
use App\Observers\SellerObserver;
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
        ProductClassAttribute::observe(ProductClassAttributeObserver::class);
        Product::observe(ProductObserver::class);
    }
}
