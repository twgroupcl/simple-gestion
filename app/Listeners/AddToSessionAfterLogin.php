<?php

namespace App\Listeners;

use App\backpack_user;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class AddToSessionAfterLogin
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
        backpack_user()->set_current_branch();
        
        if ( !is_null( session('cart_session') ) ) {
            $statusMerge = Cart::mergeCart(auth()->user(), session('cart_session'));
        }

    }
}
