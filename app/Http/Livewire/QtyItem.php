<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QtyItem extends Component
{
    // quantity
    public $qty;
    //add and dec listeners parent
    public $add, $dec;
    public $emitTo = [];

    public function render()
    {
        return view('livewire.qty-item');
    }

    public function add()
    {
        $this->qty++;
        $this->emitUp($this->add, $this->qty);
        if (count($this->emitTo) > 0) {
            foreach ($this->emitTo as $key) {
                $this->emit($key, $this->qty);
            }
        }
    }

    public function dec()
    {
        if ($this->qty >= 1) {
            $this->qty--;
            $this->emitUp($this->dec, $this->qty);
            if (count($this->emitTo) > 0) {
                foreach ($this->emitTo as $key) {
                    $this->emit($key, $this->qty);
                }
            }
        }
    }
}