<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SortingProducts extends Component
{

    public $sortingBy;

    public function render()
    {
        return view('livewire.sorting-products');
    }

    public function sortProducts()
    {
        $sortArray = [
            [
                'field' => 'created_at',
                'direction' => 'DESC',
            ],
            [
                'field' => 'name',
                'direction' => 'ASC',
            ],
            [
                'field' => 'name',
                'direction' => 'DESC',
            ],
            [
                'field' => 'current_price',
                'direction' => 'ASC',
            ],
            [
                'field' => 'current_price',
                'direction' => 'DESC',
            ],
        ];

        $this->emit('shop-grid.sort', $sortArray[$this->sortingBy]);
    }
}
