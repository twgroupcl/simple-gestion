<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;

class CardGeneral extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap-4';
    //public $productos;
    
    public function render()
    {
        return view('livewire.products.card-general', [
            'productos' => ModelsProduct::where('parent_id','=', null)->with('categories')->paginate(4),
        ]);
    }
}
