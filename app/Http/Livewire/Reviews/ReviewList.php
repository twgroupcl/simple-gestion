<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class ReviewList extends Component
{
    public $product;
    public $reviews;

    public function render()
    {
        return view('livewire.reviews.review-list');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->reviews = $product->reviews;
    }
}
