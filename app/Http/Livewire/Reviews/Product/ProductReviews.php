<?php

namespace App\Http\Livewire\Reviews\Product;

use Livewire\Component;

class ProductReviews extends Component
{
    public $product;
    public $slug;

    protected $listeners = ['refreshCard' => 'updateCard'];

    public function render()
    {
        return view('livewire.reviews.product.product-reviews');
    }

    public function mount($product, $slug)
    {
        $this->product = $product;
        $this->slug = $slug;
    }

    public function updateCard()
    {
        $this->emit('rerenderGeneralRating');
        $this->emit('refreshList');
    }
}
