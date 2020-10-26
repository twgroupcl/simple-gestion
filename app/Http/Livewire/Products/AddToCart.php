<?php
namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Barryvdh\Debugbar\Facade as Debugbar;

class AddToCart extends Component
{
    public $view = 'standard';
    public $product;
    public $qty;

    protected $listeners = [
        'addtocart.cant' => 'cant',
        'addToCart.setProduct' => 'setProduct',
    ];

    public function setProduct(Product $prod)
    {
        $this->product = $prod;
    }

    public function cant($cant)
    {
        $this->qty = $cant;
    }

    public function addToCart()
    {
        $this->emit('showToast', '¡Añadido al carro!', 'Se ha añadido al carro.', 3000, 'success');

        $this->emit('cart:add', $this->product, $this->qty);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart.' . $this->view);
    }
}