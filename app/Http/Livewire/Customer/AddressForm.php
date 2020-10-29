<?php

namespace App\Http\Livewire\Customer;

use Illuminate\Http\Request;
use Livewire\Component;

class AddressForm extends Component
{
    public $customer;
    public $communes;
    public $address;
    public $oldAddress;

    protected $listeners = [
        'loadUpdateForm' => 'loadForm',
    ];

    protected $rules = [
        "address.street" => 'required',
        "address.number" => 'required',
        "address.subnumber" => 'nullable',
        "address.commune_id" => "required",
        'address.uid' => 'nullable',
        "address.first_name" => 'nullable',
        "address.last_name" => 'nullable',
        "address.email" => 'nullable',
        "address.phone" => 'nullable',
        "address.cellphone" => 'nullable',
        "address.extra" => 'nullable',
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
        $this->oldAddress = $address;
    }

    public function save()
    {
        $this->validate();

        $addresses_data = collect(
            is_array($this->customer->addresses_data)
                ? $this->customer->addresses_data
                : json_decode($this->customer->addresses_data, true) ?? []
        );

        $target = $addresses_data->search(
            $this->oldAddress
        );

        $update = $addresses_data->replace([
            $target => $this->address
        ]);

        $this->customer->update([
            'addresses_data' => $update->toJson(),
        ]);

        $this->dispatchBrowserEvent('close-modal-form');

        return redirect()->route('customer.address');
    }
}
