<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerView extends Component
{
    public $view;
    public $search = '';
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
}
