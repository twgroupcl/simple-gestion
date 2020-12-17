<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerView extends Component
{
    public $view;
    public $search = '';
    public $selectedCustomer;
    private $customers = [];

    protected $listeners = [
        'newCustomer' => 'selectCustomer',
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
                                    ->where('email', '!=', 'cliente_generico@twgroup.com')
                                    ->paginate(10);
    }

    public function showCustomer(Customer $customer)
    {
        session()->put([
            'user.pos.isSelectedCustomerWildcard' => false,
        ]);

        $this->selectedCustomer = $customer;
    }

    public function getSelectedCustomer()
    {
        if (session()->get('user.pos.selectedCustomer')) {
            $this->selectedCustomer = session()->get('user.pos.selectedCustomer');
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

        $this->emit('customerSelected', $customer->id, $wilcard);
    }
}
