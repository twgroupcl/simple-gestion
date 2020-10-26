<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;
use App\User;



class ProductPaginate extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.products.product-paginate', [
            'users' => User::paginate(2)
        ]);
    }
}
