<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class GeneralRating extends Component
{
    public $count;
    public $generalRating;
    public $stars;
    public $starPercentages;

    public function render()
    {
        return view('livewire.reviews.general-rating');
    }

    public function mount($count, $generalRating, $stars, $starPercentages)
    {
        $this->count = $count;
        $this->generalRating = $generalRating;
        $this->stars = $stars;
        $this->stars = $starPercentages;
    }
}
