<?php

namespace App\Http\Livewire\Reviews;

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

        // dd(
        //     $this->product,
        //     $this->form['rating'],
        //     $this->form['comment'],
        //     explode(',', $this->form['pros']),
        //     explode(',', $this->form['cons'])
        // );
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
