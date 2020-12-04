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
                                    ->paginate(10);
    }

    public function showCustomer(Customer $customer)
    {
        $this->selectedCustomer = $customer;
    }

    public function getSelectedCustomer()
    {
        if (session()->get('user.pos.selectedCustomer')) {
            $this->selectedCustomer = session()->get('user.pos.selectedCustomer');
        }
    }

    public function selectCustomer(Customer $customer)
    {
        $this->selectedCustomer = $customer;
        session()->put(['user.pos.selectedCustomer' => $customer]);
        $this->emit('customerSelected', $customer->id);
    }
}
