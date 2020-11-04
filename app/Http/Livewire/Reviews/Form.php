<?php

namespace App\Http\Livewire\Reviews;

use App\Models\Customer;
use Livewire\Component;

class Form extends Component
{
    public $form;
    public $product;

    public function render()
    {
        return view('livewire.reviews.form');
    }

    public function mount($product)
    {
        $this->product = $product;
    }

    public function saveReview()
    {
        [$rules, $attributes, $messages] = $this->validation();
        $this->validate($rules, $attributes, $messages);

        $current_user = Customer::firstWhere('user_id', backpack_user()->id);
        $current_user->reviews()->create([
            'product_id' => $this->product->id,
            'title' => $this->form['title'],
            'rating' => $this->form['rating'],
            'comment' => $this->form['comment'],
            'pros' => $this->form['pros'],
            'cons' => $this->form['cons'],
        ]);
    }

    public function validation()
    {
        return [
            [
                'form.rating' => 'required',
                'form.comment' => 'required',
                'form.pros' => 'required',
                'form.cons' => 'required',
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
