<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class Reviews extends Component
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
        return view('livewire.reviews.reviews');
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
