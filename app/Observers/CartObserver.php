<?php

namespace App\Observers;

use App\Events\CartGenerated;
use App\Models\Cart;

class CartObserver
{
    public function created(Cart $cart)
    {
        event(new CartGenerated($cart));
    }
}
