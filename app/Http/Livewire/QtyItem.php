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

    public function render()
    {
        return view('livewire.qty-item');
    }

    public function set()
    {
        $this->emitUp($this->parentListener, $this->qty);
        if (count($this->emitTo) > 0) {
            foreach ($this->emitTo as $key) {
                $this->emit($key, $this->qty);
            }
        }
    }

}