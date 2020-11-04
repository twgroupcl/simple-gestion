<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class ReviewList extends Component
{
    public $product;
    public $reviews;
    public $order;

    public function render()
    {
        return view('livewire.reviews.review-list');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->updatedOrder('desc');
    }

    public function updatedOrder($order) {
        switch ($order) {
            case 'asc':
                $this->reviews = $this->product->reviews()->orderBy('created_at', 'asc')->get();
                break;

            case 'popular':
                $this->reviews = $this->product->reviews()->orderBy('rating', 'asc')->get();
                break;

            case 'high-rating':
                $this->reviews = $this->product->reviews()->orderBy('rating', 'desc')->get();
                break;

            case 'low-rating':
                $this->reviews = $this->product->reviews()->orderBy('rating', 'asc')->get();
                break;

            default:
                $this->reviews = $this->product->reviews()->latest()->get();
                break;
        }
    }
}
