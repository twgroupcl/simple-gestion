<?php

namespace App\Http\Livewire\Pos;

use App\Models\SalesBox;
use Livewire\Component;

class Navbar extends Component
{
    public $search;
    public $salesBox;

    public $listeners = [
        'salesBoxUpdated' => 'updateBoxDetails',
    ];

    public function render()
    {
        return view('livewire.pos.navbar');
    }

    public function search()
    {
        $this->emit('searchProduct', $this->search);
    }

    public function updateBoxDetails(SalesBox $salesBox)
    {
        $this->salesBox = $salesBox;
    }
}
