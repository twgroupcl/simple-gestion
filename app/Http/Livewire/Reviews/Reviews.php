<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class Reviews extends Component
{
    public $product;
    public $count;
    public $ratedReviews;
    public $stars;
    public $generalRating;

    public function render()
    {
        return view('livewire.reviews.reviews');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->count = $this->product->reviews->count();

        $this->generalRating = $this->count > 0
            ? round($this->product->reviews->sum('rating') / $this->count, 1)
            : 0;

        $this->ratedReviews = $product->reviews->groupBy('rating');

        $stars['five'] = $this->getRatedReview(5);
        $stars['four'] = $this->getRatedReview(4);
        $stars['three'] = $this->getRatedReview(3);
        $stars['two'] = $this->getRatedReview(2);
        $stars['one'] = $this->getRatedReview(1);

        $stars['five_percentage'] = $this->percentage(5);
        $stars['four_percentage'] = $this->percentage(4);
        $stars['three_percentage'] = $this->percentage(3);
        $stars['two_percentage'] = $this->percentage(2);
        $stars['one_percentage'] = $this->percentage(1);

        $this->stars = $stars;
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
