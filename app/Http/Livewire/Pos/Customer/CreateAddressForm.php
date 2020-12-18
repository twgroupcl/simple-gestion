<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Commune;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Livewire\Component;

class CreateAddressForm extends Component
{
    public $selectedCustomer;
    public $selectedAddress;
    public $addresses = [];
    public $street;
    public $number;
    public $subnumber;
    public $commune_id;
    public $communes = [];

    public $showForm;

    protected $listeners = [
        'showAddressForm' => 'showAddressForm',
    ];

    public function render()
    {
        return view('livewire.pos.customer.create-address-form');
    }

    public function selectAddress()
    {
        $this->addresses = $this->selectedCustomer->addresses;

        $this->dispatchBrowserEvent('showAddressModal');
    }

    public function loadCommunes()
    {
        $this->communes = Commune::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }

    public function createNewAddress()
    {
        if (! $this->checkAddress()) {
            return;
        }

        $address = session()->get('user.pos.selectedCustomer', false)->addresses()->create([
            'street' => $this->street,
            'number' => $this->number,
            'subnumber' => $this->subnumber,
            'commune_id' => $this->commune_id,
        ]);

        $this->selectCustomerAddress($address->id);

        $this->addresses = $this->selectedCustomer->addresses;
    }

    public function checkAddress()
    {
        if (filled($this->street) && blank($this->commune_id)) {
            $this->addError('commune_id', 'Si se escribe la calle también hay que seleccionar la comuna');
            return false;
        }

        return true;
    }

    public function selectCustomerAddress($addressId)
    {
        session()->put(['user.pos.selectedCustomerAddress' => $addressId]);
        $this->selectedAddress = CustomerAddress::find($addressId);
        $this->emit('addressSelected', $addressId);
    }

    public function showAddressForm(Customer $customer)
    {
        $this->showForm = true;
        $this->selectedCustomer = $customer;
        $this->addresses = $customer->addresses;
        $this->dispatchBrowserEvent('showAddressModal');
    }
}
