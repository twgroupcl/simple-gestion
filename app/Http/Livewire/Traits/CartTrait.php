<?php

namespace App\Http\Livewire\Traits;

use App\Services\CartService;

trait CartTrait
{
    public $cart;
    public $subtotal;

    protected $rulesCartTrait = [
        'subtotal' => 'digits_between:1,16'
    ];

    public function mountCartTrait()
    {
        $this->subtotal =  $this->cart->sub_total;
    }

    public function updatedCartTrait()
    {
        //$this->validate($this->rulesCartTrait);
        $this->cart->recalculateQtys();
        $this->cart->recalculateSubtotal();
        $totalToValidate = $this->cart->sub_total;

        $validation = \Validator::make([
            'subtotal' => $totalToValidate
        ], $this->rulesCartTrait);

        if ($validation->fails()) {
            return false;
        }

        $this->subtotal = $totalToValidate;

        $this->cart->sub_total = $totalToValidate;
        
        $this->cart->update();
        return true;
    }
}