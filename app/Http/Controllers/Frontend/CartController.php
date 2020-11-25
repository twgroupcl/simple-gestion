<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /**
     * Event form, create new business
     *
     * @return \Illuminate\View\View
     */
    public function shoppingCart(Request $request)
    {

        $cart = $this->getCart();
        if (!$cart) {
            return redirect()->back();
        }
        
        return view('shopping-cart', compact('cart'));
    }

    public function checkout()
    {
        $cart = $this->getCart();
        if (!$cart) {
            return redirect()->route('home');            
        }

        return view('checkout', compact('cart'));
    }

    /**
     * @todo create cart if not exist???
     *
     * @return Cart
     */
    private function getCart(): ?Cart
    {
        $session = Session::getId();
        $user = auth()->check() ? auth()->user() : null;
        $cart = Cart::getInstance($user,$session);

        /*if (!$cart) {
            $cart = new Cart();
            if (!$guest) {
                $cart->customer_id = auth()->user()->id;
            } else {
                $cart->session_id = $session;
            }
        }*/
        
        return $cart;
    }
}