<?php

namespace App\Listeners;

use App\backpack_user;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddToSessionBeforeLogin
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
        $session = request()->session();
        $session->flash('cart_session',$session->getId());
        $session->keep(['cart_session']);
    }
}