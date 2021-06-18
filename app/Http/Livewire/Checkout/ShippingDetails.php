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

    protected  function rules()
    {
        $rules = [];

        if ($this->shippingMethod->code === 'picking') {
            $rules['picking.name'] = ['required', 'min:2', 'max:25'];
            $rules['picking.uid'] = ['required',  new RutRule()];
            $rules['picking.email'] = ['required', 'email'];
            $rules['picking.phone'] = ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'];
        } else {
            $rules['data.address_office'] = ['required', 'max:20'];
            $rules['data.phone'] = ['required'];
        }

        if ($this->requiredInvoice) {
            $rules['invoice.uid'] = ['required',  new RutRule()];
            $rules['invoice.business_name'] = ['required', 'min:2', 'max:40'];
            $rules['invoice.business_activity_id'] = ['required'];
            $rules['invoice.email'] = ['required', 'max:50', 'email'];
            $rules['invoice.address_commune_id'] = ['required'];
            $rules['invoice.address_street'] = ['required', 'min:2', 'max:30'];
            $rules['invoice.address_office'] = ['required', 'min:2', 'max:20'];
            $rules['invoice.phone'] = ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'];
        }

        return $rules;
    }

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->requiredInvoice = $this->cart->required_invoice;
        $this->shippingMethod = $this->cart->getShippingMethod();
        $this->picking = empty($this->cart->pickup_person_info) 
                                ? [
                                    'name' => $this->cart->first_name . ' ' . $this->cart->last_name,
                                    'uid' => $this->cart->uid,
                                  ] 
                                : $this->cart->pickup_person_info;

        if ($this->requiredInvoice) {
            $invoiceValue = json_decode($this->cart->invoice_value, false);
             $this->invoice['uid'] = $invoiceValue->uid ?? '';
             $this->invoice['phone'] = $invoiceValue->phone ?? '';
             $this->invoice['email'] = $invoiceValue->email ?? '';
             $this->invoice['address_commune_id'] = $invoiceValue->address_commune_id ?? '';
             $this->invoice['address_office'] = $invoiceValue->address_office ?? '';
             $this->invoice['address_street'] = $invoiceValue->address_street ?? '';
             $this->invoice['business_activity_id'] = $invoiceValue->business_activity_id ?? '';
             $this->invoice['business_name'] = $invoiceValue->business_name ;
        }

        /* dd($this->cart->address_street); */
        $this->data['address_street'] = $this->cart->address_street ?? '';
        $this->data['address_commune_id'] = $this->cart->address_commune_id ?? '';
        $this->data['address_office'] = $this->cart->address_office ?? '';
        $this->data['phone'] = $this->cart->phone ?? '';
    }

    public function render()
    {
        return view('livewire.checkout.shipping-details');
    }

    

    public function saveData()
    {
        try {
            $validatedData = $this->validate();
            
            if ($this->shippingMethod->code === 'picking') {
                $this->savePickupData();
                $this->clearAddressData();
            } else {
                $this->saveAddressData();
                $this->clearPickupData();
            }

            if ($this->requiredInvoice) {
                $this->updateInvoiceData();
            } else {
                $this->clearInvoiceData();
            }
           
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

    public function clearAddressData()
    {
        $this->cart->address_office = null;
        $this->cart->phone = null;
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

    public function clearPickupData()
    {  
        $this->cart->pickup_person_info = null;

        $this->cart->update();
    }

    public function updateInvoiceData() 
    {
        if (!$this->requiredInvoice) return;

        $this->cart->invoice_value = [
            'status' => true,
            "first_name" => "",
            "last_name" => "",
            "uid" => $this->invoice['uid'],
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

    public function clearInvoiceData() 
    {
        $this->cart->invoice_value = [
            'status' => false,
            "first_name" => "",
            "last_name" => "",
            "uid" => '',
            "phone" => '',
            "cellphone" => "",
            "email" => '',
            "address_commune_id" => '',
            "address_street" => '',
            "address_number" => "",
            "address_office" => '',
            "business_activity_id" => '',
            "is_business" => '',
            "business_name" => '',
        ];

        $this->cart->update();
    }
}
