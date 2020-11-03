<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use App\Services\CartService;
use Illuminate\View\View;

class CartComposer
{
    
    protected $service;
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->service = new CartService($view->getData()['cart']);
        if ($view->getName() == 'livewire.cart.preview') {
            
            $view->with('total', $this->service->getSubTotal());
        }

        if ($view->getName() == 'livewire.checkout.checkout') {
            $view->with([
                'subtotal' => $this->service->getSubTotal(),
                'shippingTotal' => $this->service->getShipping()
            ]);

        }
        
    }
}