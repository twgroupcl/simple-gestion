<?php

namespace App\Http\Livewire\Pos\Cart;

use Livewire\Component;

class Item extends Component
{
    public $item;
    public $qty;
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.pos.cart.item');
    }

    public function updatedQty()
    {
        $this->emit('quantityUpdated', $this->item, $this->qty);
    }
}
