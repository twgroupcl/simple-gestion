<?php

namespace App\Http\Livewire\Pos;

use App\Models\Seller;
use Livewire\Component;

class Pos extends Component
{
    public $seller;
    public $viewMode;
    public $cash;

    protected $listeners = [
        'viewModeChanged' => 'setView',
        'foo' => 'foo',
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

    public function foo()
    {
        dd($this->cash);
    }

    public function updateCash($value)
    {
        $this->cash = $value;
    }
}
