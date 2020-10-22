<?php

namespace App\Http\Livewire\Products;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $view;
    public $product;

    public function mount(ModelsProduct $product, $view = 'products.card') {
        $this->view = $view;

        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.' . $this->view );
    }
}
