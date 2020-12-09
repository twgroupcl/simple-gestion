<?php

namespace App\Http\Livewire\Pos\Payment;

use Livewire\Component;
use App\Models\Customer;

class PaymentView extends Component
{
    public $customer;
    protected $cart ;
    public function mount()
    {

        if (session()->get('user.pos.selectedCustomer')){
            $this->customer = Customer::find(session()->get('user.pos.selectedCustomer')->id);
        }
        // if (session()->get('user.pos.cart')){
        //     $this->cart = json_decode(session()->get('user.pos.cart'));
        // }
    }
    public function render()
    {
        return view('livewire.pos.payment.payment-view');
    }
}
