<?php

namespace App\Http\Livewire\Pos\Customer;

use Livewire\Component;

class CreateCustomer extends Component
{
    protected $listeners = [
        'showForm' => 'openModalForm',
    ];

    public function render()
    {
        return view('livewire.pos.customer.create-customer');
    }

    public function openModalForm()
    {
        $this->dispatchBrowserEvent('showCustomerModal');
    }
}
