<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;

class CardGeneral extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $rows;
    public $elementsByRow;
    public $paginateBy;

    public function render()
    {
        return view('livewire.products.card-general', [
            'productos' => ModelsProduct::where('parent_id','=', null)->with('categories')->paginate($this->paginateBy),
        ]);
    }

    public function mount($rows,$elementsByRow){
        $this->rows = $rows;
        $this->elementsByRow = $elementsByRow;
    }

    public function paginationView()
    {
        return 'paginator';
    }

}
