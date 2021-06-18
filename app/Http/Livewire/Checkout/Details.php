<?php

namespace App\Http\Livewire\Checkout;

use App\Rules\RutRule;
use Livewire\Component;
use App\Rules\PhoneRule;

class Details extends Component
{
    public $data;
    public $invoice;
    public $cart;
    public $is_business;
    public $anotherDataInvoice;
    public $step; 

    public $customer_id;
    public $addresses_customer_id;

    protected $listeners = [
        'details:save' => 'save'
    ];

    protected $rules = [
        //'business_name' => '',
        'data.address_street' => 'required|min:3|max:30',
        /* 'data.address_office' => 'max:10',
        'data.address_number' => 'required|numeric|max:99999', */
        'data.address_commune_id' => 'required',
        'data.email' => 'required|email',
        /* 'data.cellphone' => 'required|max:20', */
        /* 'data.receiver_name' => 'max:255',
        'data.shipping_details' => 'max:500', */
        'data.uid' => ['required'],
    ];

    protected $messages = [
        'required' => 'Es necesario completar este campo',
        'email' => 'Revise la dirección de email',
        'exists' => 'Cuidado, ha ingresado un valor no válido',
        'min' => 'El mínimo es de 3 caracteres.',
        'numeric' => 'El valor ingresado no es numérico.',
        'max' => 'El máximo es de :max caracteres.',
    ];

    public function mount()
    {
        $this->is_business = $this->cart->is_company != 0;
        $this->customer_id = $this->cart->customer_id;

        $this->data = [
            'uid' => $this->cart->uid,
            'first_name' => $this->cart->first_name,
            'last_name' => $this->cart->last_name,
            /* 'phone' => $this->cart->phone,
            'cellphone' => $this->cart->cellphone, */
            'email' => $this->cart->email,
            'address_commune_id' => $this->cart->address_commune_id ?? (session()->get('commune_id') ?? null),
            'address_street' => $this->cart->address_street,
            /* 'address_number' => $this->cart->address_number,
            'address_office' => $this->cart->address_office,
            'business_name' => $this->cart->business_name,
            'receiver_name' => $this->cart->receiver_name,
            'shipping_details' => $this->cart->shipping_details */
        ];

        $invoice = [];
        //this variable can be simplified @todo
        //example is_business invoice
        $this->anotherDataInvoice = false;

        if ($this->cart->invoice_value) {
            $invoice = json_decode($this->cart->invoice_value, true);
            if (array_key_exists('status', $invoice)) {
                $this->anotherDataInvoice = $invoice['status'];
            }
        }

        /* $this->invoice = [
            'status' => $this->anotherDataInvoice,
            'uid' => array_key_exists('uid', $invoice) ? $invoice['uid'] : '',
            'first_name' =>  array_key_exists('first_name', $invoice) ? $invoice['first_name'] : '',
            'last_name' =>  array_key_exists('last_name', $invoice) ? $invoice['last_name'] : '',
            'phone' =>  array_key_exists('phone', $invoice) ? $invoice['phone'] : '',
            'cellphone' =>  array_key_exists('cellphone', $invoice) ? $invoice['cellphone'] : '',
            'email' =>  array_key_exists('email', $invoice) ? $invoice['email'] : '',
            'address_commune_id' =>  array_key_exists('address_commune_id', $invoice) ? $invoice['address_commune_id'] : '',
            'address_street' =>  array_key_exists('address_street', $invoice) ? $invoice['address_street'] : '',
            'address_number' =>  array_key_exists('address_number', $invoice) ? $invoice['address_number'] : '',
            'address_office' =>  array_key_exists('address_office', $invoice) ? $invoice['address_office'] : '',
            'business_activity_id' => array_key_exists('business_activity_id', $invoice) ? $invoice['business_activity_id'] : '',
            'is_business' => array_key_exists('is_business', $invoice) ? $invoice['is_business'] : false,
            'business_name' => array_key_exists('business_name', $invoice) ? $invoice['business_name'] : '',
        ]; */
    }


    public function render()
    {
        return view('livewire.checkout.details', ['customer_id' => $this->customer_id]);
    }

    public function updated($propertyName)
    {
        $dynamicRules = $this->getCustomRules();
        $this->rules = array_merge($this->rules, $dynamicRules);
        $this->validateOnly($propertyName);
    }

    private function getCustomRules()
    {
        $dynamicRules = [
            'data.first_name' => 'required|min:2|max:25',
            'data.last_name' => 'required|min:2|max:25',
        ];

        if ($this->is_business) {
            $dynamicRules = [
                'data.business_name' => 'required|min:3|max:40',
                'data.business_activity_id' => 'required'
            ];
        }

        /* if ($this->anotherDataInvoice) {
            $dynamicRules = array_merge($dynamicRules, [
                'invoice.uid' => ['required', new RutRule()],
                'invoice.phone' => ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'],
                'invoice.cellphone' => [new PhoneRule('El número ingresado no es válido'), 'max:19'],
                'invoice.email' => 'required|email',
                'invoice.address_street' => 'required|max:40',
                'invoice.address_office' => 'max:10',
                'invoice.address_number' => 'required|numeric|max:999999',
                'invoice.address_commune_id' => 'required|exists:communes,id',
                // 'invoice.business_activity_id' => 'required|exists:business_activities,id',
                // 'invoice.business_name' => 'required|min:3',
            ]); */

            /* if ($this->invoice['is_business']) {
                $dynamicRules = array_merge($dynamicRules, [
                    'invoice.business_activity_id' => 'required|exists:business_activities,id',
                    'invoice.business_name' => 'required|min:3',
                ]);
            } else {
                $dynamicRules = array_merge($dynamicRules, [
                    'invoice.first_name' => 'required|min:2|max:25',
                    'invoice.last_name' => 'required|min:2|max:25',
                ]);
            } 
        }*/

        $dynamicRules = array_merge($dynamicRules, [
            'data.uid' => ['required', new RutRule()],
            /* 'data.cellphone' => [new PhoneRule('El número ingresado no es válido'), 'max:19'],
            'data.phone' => ['required', new PhoneRule('El número ingresado no es válido'), 'max:19'], */
        ]);

        return $dynamicRules;
    }

    // public function prevStep()
    // {
    //     $this->emitUp('prev-step');
    // }
    // public function nextStep()
    // {
    //     $this->emitUp('next-step');
    // }

    public function save()
    {
        $dynamicRules = $this->getCustomRules();

        $this->rules = array_merge($this->rules,$dynamicRules);

        try {
            $validatedData = $this->validate();

            $this->invoice = [
                'status' => false,
                'uid' => '',
                'first_name' => '',
                'last_name' =>  '',
                'phone' =>  '',
                'cellphone' =>  '',
                'email' =>  '',
                'address_commune_id' => '',
                'address_street' =>  '',
                'address_number' =>  '',
                'address_office' =>  '',
                'business_activity_id' => '',
                'is_business' => '',
                'business_name' =>'',
            ];
            
            $this->data['invoice_value'] = json_encode($this->invoice);

            $this->data['is_company'] = $this->is_business;
            $this->data['json_value'] = ['business_activity_id' => $this->data['business_activity_id'] ?? null];

            if ($this->is_business) {
                $this->data['first_name'] = $this->data['business_name'];
                $this->data['last_name'] = '';
            }

            $this->cart->update($this->data);

            $this->emitUp('finishTask', $this->step + 1);

        } catch (\Throwable $th){ // (\Throwable $th) {
            $this->emitUp('notFinishTask');
            throw $th;
        }
    }

    public function updatedAddressesCustomerId($value)
    {
        if(!empty($value)) {
            $address = \App\Models\CustomerAddress::where('id', $value)->first();

            $this->is_business = $this->cart->is_company != 0;
            $this->customer_id = $this->cart->customer_id;

            $this->data = [
                'uid' => !empty($address->uid) ? $address->uid : $this->cart->uid,
                'first_name' => !empty($address->first_name) ? $address->first_name : $this->cart->first_name,
                'last_name' => !empty($address->last_name) ? $address->last_name : $this->cart->last_name,
                'phone' => !empty($address->phone) ? $address->phone : $this->cart->phone,
                'cellphone' => !empty($address->cellphone) ? $address->cellphone : $this->cart->cellphone,
                'email' => !empty($address->email) ? $address->email : $this->cart->email,
                'address_commune_id' => $address->commune_id,
                'address_street' => $address->street,
                'address_number' => $address->number,
                'address_office' => $address->subnumber,
                'business_name' => $this->cart->business_name,
                'receiver_name' => $this->cart->receiver_name,
                'shipping_details' => $address->extra
            ];

            $invoice = [];

            // if(!empty($address->uid)) {
            //     $this->anotherDataInvoice = true;
            // } else {
            //     $this->anotherDataInvoice = false;
            // }
            
            return;
        }

        $this->is_business = $this->cart->is_company != 0;
        $this->customer_id = $this->cart->customer_id;

        $this->data = [
            'uid' => $this->cart->uid,
            'first_name' => $this->cart->first_name,
            'last_name' => $this->cart->last_name,
            /* 'phone' => $this->cart->phone,
            'cellphone' => $this->cart->cellphone, */
            'email' => $this->cart->email,
            'address_commune_id' => $this->cart->address_commune_id ?? (session()->get('commune_id') ?? null),
            'address_street' => $this->cart->address_street,
            /* 'address_number' => $this->cart->address_number,
            'address_office' => $this->cart->address_office,
            'business_name' => $this->cart->business_name,
            'receiver_name' => $this->cart->receiver_name,
            'shipping_details' => $this->cart->shipping_details */
        ];

        /* $invoice = [];
        
        $this->anotherDataInvoice = false; */

        /* if ($this->cart->invoice_value) {
            $invoice = json_decode($this->cart->invoice_value, true);
            if (array_key_exists('status', $invoice)) {
                $this->anotherDataInvoice = $invoice['status'];
            }
        } */

        $this->invoice = [
            'status' => $this->anotherDataInvoice,
            'uid' => array_key_exists('uid', $invoice) ? $invoice['uid'] : '',
            'first_name' =>  array_key_exists('first_name', $invoice) ? $invoice['first_name'] : '',
            'last_name' =>  array_key_exists('last_name', $invoice) ? $invoice['last_name'] : '',
            'phone' =>  array_key_exists('phone', $invoice) ? $invoice['phone'] : '',
            'cellphone' =>  array_key_exists('cellphone', $invoice) ? $invoice['cellphone'] : '',
            'email' =>  array_key_exists('email', $invoice) ? $invoice['email'] : '',
            'address_commune_id' =>  array_key_exists('address_commune_id', $invoice) ? $invoice['address_commune_id'] : '',
            'address_street' =>  array_key_exists('address_street', $invoice) ? $invoice['address_street'] : '',
            'address_number' =>  array_key_exists('address_number', $invoice) ? $invoice['address_number'] : '',
            'address_office' =>  array_key_exists('address_office', $invoice) ? $invoice['address_office'] : '',
            'business_activity_id' => array_key_exists('business_activity_id', $invoice) ? $invoice['business_activity_id'] : '',
            'is_business' => array_key_exists('is_business', $invoice) ? $invoice['is_business'] : false,
            'business_name' => array_key_exists('business_name', $invoice) ? $invoice['business_name'] : '',
        ];

        return;
    }
}
