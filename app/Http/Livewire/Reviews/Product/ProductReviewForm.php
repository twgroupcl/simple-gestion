<?php

namespace App\Http\Livewire\Reviews\Product;

use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class ProductReviewForm extends Component
{
    public $form;
    public $product;
    public $userHasCommented;
    public $current_user;
    public $hasOrderedThisProduct;
    public $slug;

    public function render()
    {
        return view('livewire.reviews.product.product-review-form');
    }

    public function mount($product, $slug)
    {
        $this->product = $product;
        $this->slug = $slug;

        if (auth()->check()) {
            $this->userFilters();
        }
    }

    public function saveReview()
    {
        [$rules, $attributes, $messages] = $this->validation();
        $this->validate($rules, $attributes, $messages);

        $this->current_user->product_reviews()->create([
            'product_id' => $this->product->id,
            'title' => $this->form['title'],
            'rating' => $this->form['rating'],
            'comment' => $this->form['comment'],
            'pros' => $this->form['pros'] ?? '',
            'cons' => $this->form['cons'] ?? '',
        ]);

        $this->sendMail($this->form);

        $this->form = null;

        $this->emitTo('reviews.review-list', 'refreshList');
        $this->emitTo('reviews.product.product-reviews', 'refreshCard');
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

    public function sendMail($form)
    {
        try {

            $data = [
                'logo' => asset('img/logo-pyme.png'),
                'header' => 'Nueva opinión de un cliente',
                'title' => $form['title'],
                'text' => $form['comment'],
                'pros' => $form['pros'] ?? '',
                'cons' => $form['cons'] ?? '',
                'buttonText' => 'Ir al producto',
                'buttonLink' => url('/product', ['slug' => $this->slug]),
            ];

            Mail::send('vendor.maileclipse.templates.newComment', $data, function ($message) {
                $message->to($this->product->seller->email);
                $message->subject('Tu producto ha recibido una nueva opinión!');
            });

        } catch (Throwable $th) {
            logger($th->getMessage());
        }
    }
}
