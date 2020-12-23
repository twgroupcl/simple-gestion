<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Commune;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerView extends Component
{
    public $view;
    public $search = '';
    public $selectedCustomer;
    public $selectedAddress;
    public $showAddressOption = false;
    private $customers = [];

    protected $listeners = [
        'newCustomer' => 'selectCustomer',
        'addressSelected' => 'updateAddress',
    ];

    public function render()
    {
        $this->filter();
        return view('livewire.pos.customer.customer-view', ['customers' => $this->customers]);
    }

    public function updatedSearch()
    {
        $this->filter();
    }

    public function filter()
    {
        $this->customers = Customer::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%{$this->search}%")
                                    ->orWhere('uid', 'LIKE', "%{$this->search}%")
                                    ->where('email', '!=', 'cliente_generico@twgroup.com')->get();
                                   // ->paginate(10);

    }

    public function showCustomer(Customer $customer)
    {
        session()->put([
            'user.pos.isSelectedCustomerWildcard' => false,
        ]);

        $this->selectedCustomer = $customer;

        $this->changeAddressStatus(false);
    }

    public function getSelectedCustomer()
    {
        if (session()->get('user.pos.selectedCustomer')) {
            $this->selectedCustomer = session()->get('user.pos.selectedCustomer');
            $this->showAddressOption = true;
        }
    }

    public function selectCustomer(Customer $customer = null, $wilcard = null, int $addressId = null)
    {
        if ($wilcard) {
            $customer->fill($wilcard);
        }

        $this->selectedCustomer = $customer;

        session()->put([
            'user.pos.selectedCustomer' => $customer,
            'user.pos.isSelectedCustomerWildcard' => isset($wilcard),
            'user.pos.selectedCustomerAddress' => $addressId,
        ]);

        $this->changeAddressStatus(true);

        $this->emit('customerSelected', $customer->id, $wilcard, $addressId);
    }

    public function selectAddress()
    {
        $this->emit('showAddressForm', $this->selectedCustomer->id);
    }

    public function updateAddress(CustomerAddress $address)
    {
        $this->changeAddressStatus(true, $address);
    }

    public function changeAddressStatus(bool $status, $address = null)
    {
        $this->showAddressOption = session()->get('user.pos.selectedCustomer', false) && $status;
        $this->selectedAddress = $address;
        session()->put(['user.pos.selectedCustomerAddress' => $address]);
    }
}
