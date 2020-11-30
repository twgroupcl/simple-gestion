<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;

class ProductCustomAttributes extends Component
{
    protected $listeners = [
        'productShared' => 'setProductDetailsInModal',
    ];

    public $product;
    public $parentProduct;
    public $attributes;
    public $options = [];
    public $selectedChildrenId;
    public $currentPrice;

    public function render()
    {
        return view('livewire.pos.product-custom-attributes');
    }

    public function setProductDetailsInModal(Product $product, $currentPrice)
    {
        $this->product = $product;
        $this->parentProduct = $product;
        $this->currentPrice = $currentPrice;
        $this->dispatchBrowserEvent('showModal');
    }
}
