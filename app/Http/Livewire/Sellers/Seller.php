<?php

namespace App\Http\Livewire\Sellers;

use Livewire\Component;
use App\Models\Seller as ModelSeller;

class Seller extends Component
{
    public $seller;

    public function mount(ModelSeller $seller, $view = 'sellers.card')
    {
        $this->view = $view;
        $this->seller = $seller;
    }

    public function render()
    {
        return view('livewire.sellers.card');
    }
}
