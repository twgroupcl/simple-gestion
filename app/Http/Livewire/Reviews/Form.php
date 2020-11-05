<?php

namespace App\Http\Livewire\Reviews;

use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\ProductReview;
use Livewire\Component;

class Form extends Component
{
    public $form;
    public $product;
    public $userHasCommented;
    public $current_user;
    public $hasOrderedThisProduct;

    public function render()
    {
        return view('livewire.reviews.form');
    }

    public function mount($product)
    {
        $this->product = $product;

        if (auth()->check()) {
            $this->userFilters();
        }
    }

    public function saveReview()
    {
        [$rules, $attributes, $messages] = $this->validation();
        $this->validate($rules, $attributes, $messages);

        $this->current_user->reviews()->create([
            'product_id' => $this->product->id,
            'title' => $this->form['title'],
            'rating' => $this->form['rating'],
            'comment' => $this->form['comment'],
            'pros' => $this->form['pros'] ?? '',
            'cons' => $this->form['cons'] ?? '',
        ]);

        $this->form = null;

        $this->emitTo('reviews.review-list', 'refreshList');
        $this->emitTo('reviews.reviews', 'refreshCard');
    }

    public function userFilters()
    {
        $this->current_user = Customer::firstWhere('user_id', backpack_user()->id);

        $this->hasOrderedThisProduct = OrderItem::whereProductId($this->product->id)
                                                ->whereHas('order', function ($query) {
                                                    $query->whereCustomerId($this->current_user->id);
                                                })->exists();

        $this->userHasCommented = ProductReview::where('customer_id', $this->current_user->id)
                                                ->where('product_id', $this->product->id)
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
