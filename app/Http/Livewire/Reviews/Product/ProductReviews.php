<?php

namespace App\Http\Livewire\Reviews\Product;

use Livewire\Component;

class ProductReviews extends Component
{
    public $product;
    public $count;
    public $ratedReviews;
    public $stars;
    public $starPercentages;
    public $generalRating;

    protected $listeners = ['refreshCard' => 'updateCard'];

    public function render()
    {
        return view('livewire.reviews.product.product-reviews');
    }

    public function mount($product)
    {
        $this->product = $product;
    }

    public function updateCard()
    {
        $this->emit('rerenderGeneralRating');
    }
}
