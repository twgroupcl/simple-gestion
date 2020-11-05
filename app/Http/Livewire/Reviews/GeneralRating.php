<?php

namespace App\Http\Livewire\Reviews;

use Livewire\Component;

class GeneralRating extends Component
{
    public $model;
    public $count;
    public $generalRating;
    public $stars;
    public $starPercentages;

    protected $listeners = [
        'rerenderGeneralRating' => '$refresh',
    ];

    public function render()
    {
        $this->loadData();
        return view('livewire.reviews.general-rating');
    }

    public function mount($model)
    {
        $this->model = $model;
    }

    public function loadData()
    {
        $this->count = $this->model->reviews->count();

        $this->generalRating = $this->count > 0
            ? round($this->model->reviews->sum('rating') / $this->count, 1)
            : 0;

        $this->ratedReviews = $this->model->reviews->groupBy('rating');

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
