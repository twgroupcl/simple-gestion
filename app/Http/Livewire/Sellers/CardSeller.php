<?php

namespace App\Http\Livewire\Sellers;

use App\Models\Seller;
use Livewire\Component;

class CardSeller extends Component
{
    public $columnLg;
    public $columnMd;
    public $columnSm;
    public $paginateBy;
    public $showPaginate;
    public $valuesQuery;
    public $showFrom = '';
    public $limit = '';
    public $sortingField = null;
    public $sortingDirection = null;
    public $render = null;
    public $filters = null;

    public function render()
    {
        $render = [ 'sellers' => $this->getSellers($this->limit)];
        return view('livewire.sellers.card-seller', $render);
    }

    public function mount($paginateBy, $showPaginate, $columnLg = null, $showFrom, $valuesQuery = null,$limit=null)
    {
        $this->paginateBy = $paginateBy;
        $this->columnLg = $columnLg;
        $this->showPaginate = $showPaginate;
        $this->showFrom = $showFrom;
        $this->valuesQuery = $valuesQuery;
        $this->limit = $limit;
    }

    public function getSellers($limit)
    {
        return $this->baseQuery($limit);
    }

    private function baseQuery($limit = null)
    {

        $baseQuery =  Seller::where('status', '=', '1')
            ->where('is_approved', '=', '1')
            ->when($limit, function ($query) use ($limit) {
                if ($limit == 1) {
                    return $query->take(40);
                }else{
                    return $query->skip(40)->take(80);
                }
                return $query;
            })
            ->get();
        return $baseQuery;

            /* ->whereHas('seller', function ($query) {
                return $query->where('is_approved', '=', '1');
            })
            ->when($category_id, function ($query) use ($category_id) {
                if ($category_id != 0) {
                    return $query->whereHas('categories', function ($q) use ($category_id) {
                        $q->where('id', '=', $category_id);
                    });
                }
                return $query;
            })
            ->when($product_search, function ($query) use ($product_search) {
                return $query->where('name', 'LIKE', '%' . $product_search . '%');
            })
            ->when($seller_id, function ($query) use ($seller_id) {
                if ($seller_id != 0) {
                    return $query->whereHas('seller', function ($q) use ($seller_id) {
                        $q->where('id', '=', $seller_id);
                    });
                }
                return $query;
            }); */
            
    }
}
