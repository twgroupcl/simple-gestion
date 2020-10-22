<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Models\CartItem;

class Checkout extends Component
{
    public $steps;
    public $activeStep;
    public $subtotal;
    public $shippingtotal;
    public $total;
    public $cart;
    public $items;

    protected $listeners = [
        'prev-step' => 'prevStep',
        'next-step' => 'nextStep',
    ];

    public function mount(){
        $this->steps = [
            [
                'name'=> 'Carro',
                'status'=> 'active',
                'number'=>1,
                'icon'=> 'czi-cart',
                'prev-button'=> 'Volver a comprar',
                'next-button'=> 'Ingresar datos envío',

            ],
            [
                'name'=> 'Detalle',
                'status'=> 'active',
                'number'=>2,
                'icon'=> 'czi-user-circle',
                'prev-button'=> 'Volver al carro',
                'next-button'=> 'Seleccionar metodos de envío',

            ],
            [
                'name'=> 'Envio',
                'status'=> '',
                'number'=>3,
                'icon'=> 'czi-package',
                'prev-button'=> 'Volver a metodos de envío',
                'next-button'=> 'Seleccionar metodo de pago',

            ],
            [
                'name'=> 'Pago',
                'status'=> '',
                'number'=>4,
                'icon'=> 'czi-card',
                'prev-button'=> 'Volver a metodo de pago',
                'next-button'=> 'Realizar pago',

            ],
            [
                'name'=> 'Revisión',
                'status'=> '',
                'number'=>5,
                'icon'=> 'czi-check-circle',
                'prev-button'=> 'Continuar comprando',
                'next-button'=> 'Descargar',

            ],

        ];


        //Initialize active step
        $this->activeStep = $this->steps[1];

        //Get items
        $this->items = $this->getItems();
        //dd($this->cart);
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }

    public function prevStep(){
        //$this->activestep -= 1;
        //$this->steps[$this->activestep ]['status'] = '';
        $currentStep  = array_search($this->activeStep, $this->steps);
        $this->activeStep = $this->steps[$currentStep - 1];
    }
    public function nextStep(){
        $currentStep  = array_search($this->activeStep, $this->steps);
        $this->activeStep = $this->steps[$currentStep + 1];

    }

    public function getItems(){
        return CartItem::whereCartId($this->cart->id)->with('product')->get();

    }

}
