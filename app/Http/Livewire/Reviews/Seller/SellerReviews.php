<?php

namespace App\Http\Livewire\Reviews\Seller;

use Livewire\Component;

class SellerReviews extends Component
{
    public $seller;
    public $count;
    public $generalRating;
    public $stars;
    public $starPercentages;

    protected $listeners = ['refreshCard' => 'updateCard'];

    public function render()
    {
        return view('livewire.reviews.seller.seller-reviews');
    }

    public function mount($seller)
    {
        $this->seller = $seller;
    }

    public function updateCard()
    {
        $this->emit('rerenderGeneralRating');
    }
}
