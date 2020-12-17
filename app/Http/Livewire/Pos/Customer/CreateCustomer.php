<?php

namespace App\Http\Livewire\Pos\Customer;

use App\Models\Commune;
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
    public $street;
    public $number;
    public $subnumber;
    public $commune_id;
    public $communes = [];

    public function render()
    {
        return view('livewire.pos.customer.create-customer');
    }

    public function mount()
    {
        $this->clearFields();
    }

    public function createWildcardCustomer()
    {
        $this->customValidation();

        if (! $this->checkAddress()) {
            return;
        }

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

        $address = $this->createAddress($wilcardCustomer);

        $this->clearFields();
        $this->emit('newCustomer', $wilcardCustomer->id, $customer, $address);
    }

    public function createNewCustomer()
    {
        $this->customValidation();

        if (! $this->checkAddress()) {
            return;
        }

        $customer = Customer::withoutEvents(function () {
            return Customer::create([
                'uid' => $this->uid,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'cellphone' => $this->cellphone,
                'customer_segment_id' => 1,
                'company_id' => 1,
            ]);
        });

        $address = $this->createAddress($customer);

        $this->clearFields();
        $this->emit('newCustomer', $customer->id, null, $address);
    }

    public function loadCommunes()
    {
        $this->communes = Commune::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }

    public function createAddress($customer)
    {
        if (blank($this->street) || blank($this->commune_id)) {
            return null;
        }

        return $customer->addresses()->create([
            'street' => $this->street,
            'number' => $this->number,
            'subnumber' => $this->subnumber,
            'commune_id' => $this->commune_id,
        ])->id;
    }

    public function checkAddress()
    {
        if (filled($this->street) && blank($this->commune_id)) {
            $this->addError('commune_id', 'Si se escribe la calle también hay que seleccionar la comuna');
            return false;
        }

        return true;
    }

    public function clearFields()
    {
        $this->street = '';
        $this->number = '';
        $this->subnumber = '';
        $this->uid = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->cellphone = '';
        $this->commune_id = null;

        $this->dispatchBrowserEvent('hideCustomerModal');
    }

    public function customValidation()
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
    }
}
