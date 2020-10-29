<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchNavbarMovile extends Component
{
    public $query    = '';

    public function render()
    {
        return view('livewire.search-navbar-movile');
    }

    public function search(){
        return redirect()->to('/search-products/0/'.$this->query);
    }
}
