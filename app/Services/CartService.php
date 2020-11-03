<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

class CartService 
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getShipping()
    {
        return 2 * $this->cart->items_qty;
    }

    
}