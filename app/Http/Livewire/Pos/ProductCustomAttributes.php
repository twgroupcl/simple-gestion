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
    public $attributes;

    public function render()
    {
        return view('livewire.pos.product-custom-attributes');
    }

    public function setProductDetailsInModal(Product $product, $attributes)
    {
        $this->attributes = $attributes;
        $this->product = $product;
        $this->dispatchBrowserEvent('showModal');
    }
}
