<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Customer;
use Livewire\Component;

class CreateCustomer extends Component
{
    public $uid;
    public $first_name;
    public $last_name;
    public $email;

    protected $rules = [
        'uid' => 'required|string',
        'first_name' => 'required|string',
        'email' => 'required|email|unique:users',
    ];

    public function render()
    {
        return view('livewire.pos.customer.create-customer');
    }

    public function createCustomer()
    {
        $this->validate();
        Customer::create([
            'uid' => $this->uid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => strtoupper(
                str_replace('.', '', $this->uid)
            ),
        ]);
    }
}
