<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Models\PaymentMethod;

class Payments extends Component
{
    public $payments;

    public function mount()
    {
        $this->payments = $this->getPayments();

    }
    public function render()
    {
        return view('livewire.checkout.payments');
    }

    public function getPayments(Type $var = null)
    {
       return PaymentMethod::where('status',1)->get();
    }

    public function goPay()
    {
        $this->emitUp('pay');
    }
}
