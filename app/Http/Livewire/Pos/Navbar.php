<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class Navbar extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.pos.navbar');
    }

    public function search()
    {
        $this->emit('searchProduct', $this->search);
    }
}
