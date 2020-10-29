<?php

namespace App\Http\Livewire\Customer;

use Illuminate\Http\Request;
use Livewire\Component;

class AddressForm extends Component
{
    public $customer;
    public $communes;
    public $address;

    protected $listeners = [
        'loadUpdateForm' => 'loadForm',
    ];

    public function render()
    {
        return view('livewire.customer.address-form', [
            'customer' => $this->customer,
            'communes' => $this->communes,
            'address' => $this->address,
        ]);
    }

    public function mount($communes, $customer)
    {
        $this->communes = $communes;
        $this->customer = $customer;
    }

    public function loadForm($address)
    {
        $this->dispatchBrowserEvent('modal-form');
        $this->address = $address;
    }

    public function save()
    {
    }
}
