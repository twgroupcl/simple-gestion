<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Customer;
use App\Rules\RutRule;
use Livewire\Component;

class CreateCustomer extends Component
{
    public $uid;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $cellphone;

    public function render()
    {
        return view('livewire.pos.customer.create-customer');
    }

    public function createCustomer()
    {
        $this->validate(
            [
                'uid' => ['required', new RutRule()],
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'nullable|email',
                'phone' => 'nullable',
                'cellphone' => 'nullable',
            ],
            [
                'required' => 'El campo :attribute es obligatorio',
                'email' => 'El campo debe ser un email',
            ],
            [
                'first_name' => 'Nombre',
                'last_name' => 'Apellido',
            ]
        );

        $wilcardCustomer = Customer::withoutEvents(function () {
            return Customer::firstOrCreate(
                ['email' => 'cliente_generico@twgroup.com'],
                [
                    'uid' => '99999999-9',
                    'first_name' => 'Cliente Genérico',
                    'password' => bcrypt('123456789'),
                    'customer_segment_id' => 1,
                    'company_id' => 1,
                ],
            );
        });

        $customer = new Customer([
            'uid' => $this->uid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cellphone' => $this->cellphone,
        ]);

        $this->emit('newCustomer', $wilcardCustomer->id, $customer);
    }
}
