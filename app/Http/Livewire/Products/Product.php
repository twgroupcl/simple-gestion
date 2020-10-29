<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;

class Product extends Component
{
    public $view;
    public $product;
    use WithPagination;

    public function mount(ModelsProduct $product, $view = 'products.card')
    {
        $this->view = $view;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.' . $this->view);
    }
}
