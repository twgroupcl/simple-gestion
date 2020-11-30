<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SortingProducts extends Component
{

    public $sortingBy;
    public $showFrom;

    public function render()
    {
        return view('livewire.sorting-products');
    }

    public function mount($showFrom = 'shop-grid')
    {
        $this->showFrom = $showFrom;
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
            [
                'field' => 'random',
                'direction' => 'random',
            ],
        ];

        $this->emit('shop-grid.sort', $sortArray[$this->sortingBy]);
    }
}
