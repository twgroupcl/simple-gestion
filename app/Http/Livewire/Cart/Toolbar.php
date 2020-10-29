<?php

namespace App\Http\Livewire\Cart;

use App\Http\Livewire\Traits\Cursor;
use App\Models\Cart;
use Livewire\Component;

class Toolbar extends Component
{
    use Cursor;

    public $subtotal;
    public $count;

    protected $listeners = [
        'cart-toolbar.update' => 'update',
    ];

    public function update($subtotal, $count)
    {
        $this->subtotal = $subtotal;
        $this->count = $count;
        $this->setCursor('not-allowed');
        if ($count > 0) {
            $this->setCursor('auto');
        }
    }

    public function mount()
    {
        if ( $this->count == 0) {
            $this->setCursor('not-allowed');
        } 
    }

    public function render()
    {
        return view('livewire.cart.toolbar', []);
    }

}
