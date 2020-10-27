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
            'productos' => ModelsProduct::where('status','=','1')->where('parent_id','=', null)->where('is_approved','=','1')->with('categories')->orderBy('id','DESC')->paginate($this->paginateBy),
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
