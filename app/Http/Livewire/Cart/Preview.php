<?php

namespace App\Http\Livewire\Cart;

use App\Models\CartItem;
use Livewire\Component;

class Preview extends Component
{
    public $cart;
    public $items;
    public $total;
    public $cartChange;

    protected $listeners = [
        'change' => 'change',
        'deleteItem' => 'deleteItem'
    ];

    public function mount()
    {
        $this->items = $this->getItems();
        $this->cartChange = 'disabled';
        $this->total = $this->getTotal();
    }

    public function render()
    {
        return view('livewire.cart.preview', ['items' => $this->items]);
    }

    public function change(CartItem $item, int $qty)
    {
        $this->items->find($item->id)->qty = $qty;
        $this->cartChange = "";
    }

    public function updateCart($items)
    {
        //validate

        // @todo update items
        foreach ($items as $key) {
            CartItem::find($key['id'])->update($key);
        }
        $this->total = $this->getTotal();
        $this->cartChange = 'disabled';
        $this->redirect('/shopping-cart');
    }


    public function deleteItem($itemId)
    {
        CartItem::find($itemId)->delete();
        $this->emit('cart-counter:decrease');
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
