<?php

namespace App\Listeners;

use App\Models\Product;
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
        $product = Product::findOrFail($event->productId);

        $sendAlert = !$product->haveSufficientQuantity($product->critical_stock);

        if ($sendAlert) {
            dd('alert was send');
        }
    }
}
