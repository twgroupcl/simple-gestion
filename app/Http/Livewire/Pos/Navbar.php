<?php

namespace App\Http\Livewire\Pos;

use App\Models\SalesBox;
use Livewire\Component;

class Navbar extends Component
{
    public $search;
    public $salesBox;
    public $checked;

    public $listeners = [
        'salesBoxUpdated' => 'updateBoxDetails',
    ];

    public function render()
    {
        return view('livewire.pos.navbar');
    }

    public function updateBoxDetails(SalesBox $salesBox = null)
    {
        $this->salesBox = $salesBox;

        $this->checked = isset($this->salesBox->id);
    }
}
