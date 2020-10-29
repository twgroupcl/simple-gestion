<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class AddressItem extends Component
{
    public $address;
    public $communes;

    public function render()
    {
        return view('livewire.customer.address-item', [
            'address' => $this->address,
            'communes' => $this->communes,
        ]);
    }

    public function mount($communes, $address)
    {
        $this->communes = $communes;
        $this->address = $address;
    }

    public function updateAddress()
    {
        $this->emitTo('customer.address-form', 'loadUpdateForm', $this->address);
    }
}
