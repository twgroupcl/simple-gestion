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

    public function render()
    {
        return view('livewire.reviews.reviews');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->loadData();
    }

    public function loadData()
    {
        $this->count = $this->product->reviews->count();

        $this->generalRating = $this->count > 0
            ? round($this->product->reviews->sum('rating') / $this->count, 1)
            : 0;

        $this->ratedReviews = $this->product->reviews->groupBy('rating');

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
}
