<?php

namespace App\Http\Livewire\Pos;

use App\Models\Seller;
use Livewire\Component;

class Pos extends Component
{
    public $seller;

    public function render()
    {
        return view('livewire.pos.pos');
    }

    public function mount()
    {
        $this->seller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
    }
}
