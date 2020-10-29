<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class AddressList extends Component
{
    public $customer;
    public $communes;

    public function render()
    {
        return view('livewire.customer.address-list', [
            'customer' => $this->customer,
            'communes' => $this->communes,
        ]);
    }

    public function mount($communes, $customer)
    {
        $this->communes = $communes;
        $this->customer = $customer;
    }
}
