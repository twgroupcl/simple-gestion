<?php

namespace App\Http\Livewire\Reviews\Seller;

use Livewire\Component;
use Livewire\WithPagination;

class SellerReviewList extends Component
{
    use WithPagination;

    protected $queryString = ['sort_review'];
    protected $listeners = ['refreshList' => 'resetList'];
    public $seller;
    public $sort_review;
    public $perPage = 5;

    public function render()
    {
        return view('livewire.reviews.seller.seller-review-list', [
            'reviews' => $this->seller->reviews()->customSort($this->sort_review)->simplePaginate($this->perPage)
        ]);
    }

    public function mount($seller)
    {
        $this->seller = $seller;
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 5;
    }

    public function resetList()
    {
        $this->reset(['sort_review', 'page']);
    }
}
