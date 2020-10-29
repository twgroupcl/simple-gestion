<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;

class CardGeneral extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $columnLg;
    public $columnMd;
    public $columnSm;
    public $paginateBy;
    public $showPaginate;
    public $valuesQuery;
    public $showFrom = '';
    
    public function render()
    {
        //$render = ['productos' =>  (!empty($this->query))?$this->searchProduct():$this->getProducts() ];
        $render = ['productos' =>  (!empty($this->showFrom))?(($this->showFrom == 'searchCategory')?$this->getProductsByCategory($this->valuesQuery):$this->searchProduct($this->valuesQuery)):$this->getProducts() ];
        return view('livewire.products.card-general', $render);
    }

    public function mount($paginateBy,$showPaginate,$columnLg=null,$showFrom,$valuesQuery=null){
        $this->paginateBy = $paginateBy;
        $this->columnLg = $columnLg;
        $this->showPaginate = $showPaginate;
        $this->showFrom = $showFrom;
        $this->valuesQuery = $valuesQuery;
    }

    public function getProducts(){
        return ModelsProduct::where('status','=','1')->where('parent_id','=', null)->where('is_approved','=','1')->with('categories')->orderBy('id','DESC')->whereHas('seller', function ($query) {
            return $query->where('is_approved', '=', '1');
        })->paginate($this->paginateBy);
    }

    public function searchProduct($data)
    {
        $idCategory = $data['category'];
        $product = $data['product'];
        if($idCategory != 0){
            return ModelsProduct::where('status','=','1')->where('is_approved','=','1')->where('parent_id','=', null)->where('name','LIKE','%'.$product.'%')->whereHas('categories', function ($query) use ($idCategory) {
                return $query->where('product_category_id', '=', $idCategory);
            })->paginate($this->paginateBy);
        }else{
            return ModelsProduct::where('status','=','1')->where('is_approved','=','1')->where('parent_id','=', null)->where('name','LIKE','%'.$product.'%')->with('categories')->paginate($this->paginateBy);
        }
    }

    public function getProductsByCategory($data){

        if($data['category'] == 0){
            $category = false;
            return ModelsProduct::where('status','=','1')->where('is_approved','=','1')->where('parent_id','=', null)->with('categories')->paginate($this->paginateBy);
        }else{
            $category = ProductCategory::where('id','=',$data['category'])->with('products')->first();
            return $category->products()->paginate($this->paginateBy);
        }
    }

    public function paginationView()
    {
        return 'paginator';
    }

}
