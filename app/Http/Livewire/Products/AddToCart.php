<?php
namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class AddToCart extends Component
{
    public $view = 'standard';
    public $product;
    public $qty;

    protected $listeners = [
        'addtocart.cant' => 'cant',
    ];

    public function cant($cant)
    {
        $this->qty = $cant;
    }

    public function addToCart(Product $product)
    {

        $this->dispatchBrowserEvent('show-toast', ['message' => 'Se ha añadido al carro']);


        $this->emit('cart:add', $product, $this->qty);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart.' . $this->view);
    }
}