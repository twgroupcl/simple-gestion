<?php

namespace App\Http\Livewire\Checkout;

use App\Rules\RutRule;
use Livewire\Component;
use App\Rules\PhoneRule;

class ShippingDetails extends Component
{
    public $shippingMethod;
    public $cart;
    public $data;
    public $picking;
    public $invoice;
    public $requiredInvoice = false;

    protected $listeners = [
        'shipping-details:save' => 'saveData'
    ];

    protected $messages = [
        'required' => 'Es necesario completar este campo',
        'email' => 'Revise la dirección de email',
        'exists' => 'Cuidado, ha ingresado un valor no válido',
        'min' => 'El mínimo es de 3 caracteres.',
        'numeric' => 'El valor ingresado no es numérico.',
        'max' => 'El máximo es de :max caracteres.',
    ];

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->shippingMethod = $this->cart->getShippingMethod();
        $this->picking = empty($this->cart->pickup_person_info) ? [] : $this->cart->pickup_person_info;

        $this->data['address_street'] = $this->cart->address_street;
        $this->data['address_commune_id'] = $this->cart->address_commune_id;
    }

    public function render()
    {
        return view('livewire.checkout.shipping-details');
    }

    protected  function rules()
    {
        $rules = [];

        if ($this->shippingMethod->code === 'picking') {
            $rules['picking.name'] = ['required', 'min:2', 'max:25'];
            $rules['picking.uid'] = ['required',  new RutRule()];
            $rules['picking.email'] = ['required', 'email'];
            $rules['picking.phone'] = ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'];
        } else {
            $rules['data.address_office'] = ['required', 'max:10'];
            $rules['data.phone'] = ['required'];
        }

        if ($this->requiredInvoice) {
            $rules['invoice.uid'] = ['required',  new RutRule()];
            $rules['invoice.business_name'] = ['required', 'min:2', 'max:40'];
            $rules['invoice.business_activity_id'] = ['required'];
            $rules['invoice.email'] = ['required', 'max:50', 'email'];
            $rules['invoice.address_commune_id'] = ['required'];
            $rules['invoice.address_street'] = ['required', 'min:2', 'max:40'];
            $rules['invoice.address_office'] = ['min:2', 'max:10'];
            $rules['invoice.phone'] = ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'];
        }

        return $rules;
    }

    public function saveData()
    {
        try {
            $validatedData = $this->validate();
            
            if ($this->shippingMethod->code === 'picking') {
                $this->savePickupData();
            } else {
                $this->saveAddressData();
            }
           
            $this->updateInvoiceData();
           
            $this->cart->required_invoice = $this->requiredInvoice;

            $this->cart->update();
    
            $this->emitUp('finishTask');

        } catch (\Throwable $th){ // (\Throwable $th) {
            $this->emitUp('notFinishTask');
            throw $th;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveAddressData()
    {
        $this->cart->address_office = $this->data['address_office'];
        $this->cart->phone = $this->data['phone'];
        $this->cart->update();
    }

    public function savePickupData()
    {  
        $this->cart->pickup_person_info = [
            'uid' => $this->picking['uid'],
            'email' => $this->picking['email'],
            'name' => $this->picking['name'],
            'phone' => $this->picking['phone'],
        ];

        $this->cart->update();
    }

    public function updateInvoiceData() 
    {
        if (!$this->requiredInvoice) return;

        $this->cart->invoice_value = [
            'status' => true,
            "first_name" => "",
            "last_name" => "",
            "phone" => $this->invoice['phone'],
            "cellphone" => "",
            "email" => $this->invoice['email'],
            "address_commune_id" => $this->invoice['address_commune_id'],
            "address_street" => $this->invoice['address_street'],
            "address_number" => "",
            "address_office" => $this->invoice['address_office'],
            "business_activity_id" => $this->invoice['business_activity_id'],
            "is_business" => true,
            "business_name" => $this->invoice['business_name'],
        ];

        $this->cart->update();
    }
}
