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

    public function getSubTotal ()
    {
        return  $this->getTotal();
    }

    private function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item->price * $item->qty;
        }
        return $total;
    }

    /**
     * replace for getItemsProperty???
     *
     * @return void
     */
    private function getItems()
    {
        return CartItem::whereCartId($this->cart->id)->get();
    }
}