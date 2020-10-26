<?php

namespace App\Http\Livewire\Cart;

use App\Models\CartItem;
use Livewire\Component;

class Preview extends Component
{
    public $cart;
    public $items;
    public $total;

    protected $listeners = [
        'change' => 'change',
        'deleteItem' => 'deleteItem'
    ];

    public function mount()
    {
        $this->items = $this->getItems();
        $this->total = $this->getTotal();
    }

    public function render()
    {
        return view('livewire.cart.preview');
    }

    public function change()
    {
        $this->emit('cart.updateSubtotal',null);

        
        $this->total = $this->getTotal();
    }

    public function deleteItem()
    {
        $this->change();
        $this->items = $this->getItems();
        $this->total = $this->getTotal();
    }

    public function checkout()
    {
        return redirect()->route('go-checkout');
    }

    private function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item->price * $item->qty;
        }
        return $total;
    }

    /**
     * replace for getItemsProperty???
     *
     * @return void
     */
    private function getItems()
    {
        return CartItem::whereCartId($this->cart->id)->get();
    }
}
