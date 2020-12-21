<?php

namespace App\Listeners;

use App\Models\Product;
use App\Mail\CriticalStockAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckCriticalStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $product = Product::find($event->productId);

        if (!$product) return false;

        $sendAlert = !$product->haveSufficientQuantity($product->critical_stock);

        if ($sendAlert) {
            Mail::to($product->seller->email)->send(new CriticalStockAlert($product));
        }
    }
}
