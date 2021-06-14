<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class ShippingDetails extends Component
{
    public $shippingMethod;
    public $cart;
    public $data;
    public $picking;
    public $invoice;
    public $requiredInvoice;

    protected $listeners = [
        'shipping-details:save' => 'saveData'
    ];

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->shippingMethod = $this->cart->getShippingMethod();

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
            $rules['picking.name'] = ['required'];
            $rules['picking.uid'] = ['required'];
            $rules['picking.email'] = ['required'];
            $rules['picking.phone'] = ['required'];
        } else {
            $rules['data.address_office'] = ['required'];
            $rules['data.phone'] = ['required'];
        }

        if ($this->requiredInvoice) {
            $rules['invoice.uid'] = ['required'];
            $rules['invoice.business_name'] = ['required'];
            $rules['invoice.business_activity_id'] = ['required'];
            $rules['invoice.email'] = ['required'];
            $rules['invoice.address_commune_id'] = ['required'];
            $rules['invoice.address_street'] = ['required'];
            $rules['invoice.address_office'] = ['required'];
            $rules['invoice.phone'] = ['required'];
        }

        return $rules;
    }

    public function saveData()
    {
        dd(123);
        try {
            $validatedData = $this->validate();

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
    }

    public function updateInvoiceData() 
    {
        if (!$requiredInvoice) return;

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
            "is_business" => true,"
            business_name" => $this->invoice['business_name'],
        ];

        $this->cart->update();
    }
}
