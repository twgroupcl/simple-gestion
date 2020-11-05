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
        $this->loadData();
    }

    public function loadData()
    {
        $this->count = $this->seller->reviews->count();

        $this->generalRating = $this->count > 0
            ? round($this->seller->reviews->sum('rating') / $this->count, 1)
            : 0;

        $this->ratedReviews = $this->seller->reviews->groupBy('rating');

        $this->stars = [
            'five' => $this->getRatedReview(5),
            'four' => $this->getRatedReview(4),
            'three' => $this->getRatedReview(3),
            'two' => $this->getRatedReview(2),
            'one' => $this->getRatedReview(1),
        ];

        $this->starPercentages = [
            'five' => $this->percentage($this->stars['five']),
            'four' => $this->percentage($this->stars['four']),
            'three' => $this->percentage($this->stars['three']),
            'two' => $this->percentage($this->stars['two']),
            'one' => $this->percentage($this->stars['one']),
        ];
    }

    public function percentage($value)
    {
        return $value === 0
            ? 1
            : (100 * ($value)) / $this->count;
    }

    public function getRatedReview(int $starCount) : int
    {
        return optional(
            $this->ratedReviews->pull($starCount)
        )->count() ?? 0;
    }

    public function updateCard()
    {
        $this->loadData();
    }
}
