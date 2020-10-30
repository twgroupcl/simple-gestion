<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QtyItem extends Component
{
    // quantity
    public $qty;
    //add and dec listeners parent
    public $parentListener = "setQty";
    public $emitTo = [];

    protected $rules = [
        'qty' => 'required|integer|gte:1|lte:9999',
    ];

    protected $messages = [
        'gte' => 'La cantidad mayor o igual a 1.',
        'lte' => 'La cantidad supera el límite',
        'qty.required' => 'Debe indicar una cantidad.',
        'qty.integer' => 'Revise la cantidad.'
    ];

    public function render()
    {
        return view('livewire.qty-item');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function set()
    {
        // first send, after check. 
        //responsibility on the part of the client
        $this->emitUp($this->parentListener, $this->qty);
        if (count($this->emitTo) > 0) {
            foreach ($this->emitTo as $key) {
                $this->emit($key, $this->qty);
            }
        }   

        $this->validate();
    }

}