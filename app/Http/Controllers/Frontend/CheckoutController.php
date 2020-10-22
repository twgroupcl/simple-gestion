<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    /**
     * Event form, create new business
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $session = Session::getId();
        $cart = Cart::where('session_id', $session)->exists() ? Cart::where('session_id', $session)->first() : null;
        if (!$cart) {
            return redirect()->back();
        }

        return view('checkout', compact('cart'));
    }

}
