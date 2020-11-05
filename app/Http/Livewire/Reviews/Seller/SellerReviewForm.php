<?php

namespace App\Http\Livewire\Reviews\Seller;

use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\SellerReview;
use Livewire\Component;

class SellerReviewForm extends Component
{
    public $form;
    public $seller;
    public $userHasCommented;
    public $current_user;
    public $hasOrderedThisProduct;

    public function render()
    {
        return view('livewire.reviews.seller.seller-review-form');
    }

    public function mount($seller)
    {
        $this->seller = $seller;

        if (auth()->check()) {
            $this->userFilters();
        }
    }

    public function saveReview()
    {
        [$rules, $attributes, $messages] = $this->validation();
        $this->validate($rules, $attributes, $messages);

        $this->current_user->seller_reviews()->create([
            'seller_id' => $this->seller->id,
            'title' => $this->form['title'],
            'rating' => $this->form['rating'],
            'comment' => $this->form['comment'],
            'pros' => $this->form['pros'] ?? '',
            'cons' => $this->form['cons'] ?? '',
        ]);

        $this->form = null;

        $this->emitTo('reviews.seller.seller-review-list', 'refreshList');
        $this->emitTo('reviews.seller.seller-reviews', 'refreshCard');
    }

    public function userFilters()
    {
        $this->current_user = Customer::firstWhere('user_id', backpack_user()->id);

        $this->hasOrderedThisProduct = OrderItem::whereSellerId($this->seller->id)
                                                ->whereHas('order', function ($query) {
                                                    $query->whereCustomerId($this->current_user->id);
                                                })->exists();

        $this->userHasCommented = $this->current_user->seller_reviews()
                                                    ->where('seller_id', $this->seller->id)
                                                    ->exists();
    }

    public function validation()
    {
        return [
            [
                'form.rating' => 'required',
                'form.comment' => 'required',
            ],
            [
                'required' => 'Por favor complete el campo :attribute'
            ],
            [
                'form.rating' => 'clasificación',
                'form.comment' => 'opinión',
                'form.pros' => 'pros',
                'form.cons' => 'contras',
            ],
        ];
    }
}
