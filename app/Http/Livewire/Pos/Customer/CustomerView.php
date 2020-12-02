<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Customer;
use Livewire\Component;

class CustomerView extends Component
{
    public $view;
    public $search;
    private $customers = [];

    public function render()
    {
        return view('livewire.pos.customer.customer-view', ['customers' => $this->customers]);
    }

    public function updatedSearch()
    {
        $this->customers = Customer::where('first_name', 'LIKE', "%{$this->search}%")
                                    ->orWhere('uid', 'LIKE', "%{$this->search}%")
                                    ->paginate(10);
    }
}
