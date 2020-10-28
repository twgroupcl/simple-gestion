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
    public $columnLg;
    public $columnMd;
    public $columnSm;
    public $paginateBy;
    public $showPaginate;
    
    public function render()
    {
        return view('livewire.products.card-general', [
            'productos' => $this->getProducts()
        ]);
    }

    public function mount($paginateBy,$showPaginate,$columnLg = null){
        $this->paginateBy = $paginateBy;
        $this->columnLg = $columnLg;
        $this->showPaginate = $showPaginate;
    }

    public function getProducts(){
        return ModelsProduct::where('status','=','1')->where('parent_id','=', null)->where('is_approved','=','1')->with('categories')->orderBy('id','DESC')->paginate($this->paginateBy);
    }

    public function paginationView()
    {
        return 'paginator';
    }

}
