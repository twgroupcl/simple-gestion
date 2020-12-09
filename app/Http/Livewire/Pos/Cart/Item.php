<?php

namespace App\Http\Livewire\Pos\Cart;

use Livewire\Component;

class Item extends Component
{
    public $item;
    public $qty;
    protected $listeners = [
        'item.updatedCustomQty' => 'updatedCustomQty',
    ];
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.pos.cart.item');
    }

   /*  public function updatedQty()
    {
        $this->emit('quantityUpdated', $this->item, $this->qty);
    } */
    public function updatedQty($value)
    {
        $this->qty += $value;
        $this->emit('quantityUpdated', $this->item, $this->qty);
    }
    public function updatedCustomQty($product, $value)
    {
        if ($product == $this->item) {
            $this->qty = $value;
        }

    }
}
