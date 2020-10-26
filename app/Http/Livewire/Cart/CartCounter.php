<?php

namespace App\Http\Livewire\Cart;

use App\Http\Livewire\Traits\Cursor;
use App\Models\Cart;
use \Illuminate\Session\SessionManager;
use Livewire\Component;

class CartCounter extends Component
{
    use Cursor;

    public $count = 0;

    protected $listeners = [
        'cart-counter.setCount' => 'setCount',
    ];

    public function mount($count = 0)
    {
        $this->count = $count;

        if ($this->count <= 0) {
            $this->setCursor('not-allowed');
        }
    }

    public function setCount($count)
    {
        $this->count = $count;
        $this->setCursor('not-allowed');
        if ($this->count > 0) {
            $this->setCursor('auto');
        }
    }


    public function render()
    {
        return view('livewire.cart.counter');
    }

}
