<?php

namespace App\Http\Livewire\Pos;

use App\Models\SaleBox;
use App\Models\SalesBox;
use App\Models\Seller;
use Livewire\Component;

class Pos extends Component
{
    public $seller;
    public $viewMode;

    protected $listeners = [
        'viewModeChanged' => 'setView',
    ];

    public function render()
    {
        return view('livewire.pos.pos');
    }

    public function mount()
    {
        $this->seller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        $this->setView('productList');
    }

    public function setView($view = null)
    {
        $this->viewMode = $view;
    }
}
