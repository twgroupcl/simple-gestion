<?php

namespace App\Http\Livewire\Pos;

use App\Models\Seller;
use Livewire\Component;

class Pos extends Component
{
    public $seller;
    public $viewMode;
    public $cash;
    protected $cart;
    protected $customer;

    protected $listeners = [
        'viewModeChanged' => 'setView',


    ];

    public function render()
    {
        return view('livewire.pos.pos');
    }

    public function mount()
    {
        $this->seller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        $this->setView('productList');
    }

    public function setView($view = null)
    {
        $this->viewMode = $view;
    }

    public function updateCash($value)
    {
        $this->cash = $value;
        $this->emit('cart.confirmPayment', $value);
    }


    public function getTotalCart()
    {
        $this->cart =  json_decode(session()->get('user.pos.cart'));

        return currencyFormat($this->cart->total ?? 0, 'CLP', true) ;
    }
    public function getSelectedCustomer()
    {
        $this->customer =  session()->get('user.pos.selectedCustomer');

        return json_encode($this->customer);
    }
}
