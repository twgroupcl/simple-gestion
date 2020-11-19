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
    public $sortingField = null;
    public $sortingDirection = null;
    public $render = null;
    public $filters = null;

    public function render()
    {
        $render = [ 'sellers' => $this->getSellers()];
        return view('livewire.sellers.card-seller', $render);
    }

    public function mount($paginateBy, $showPaginate, $columnLg = null, $showFrom, $valuesQuery = null)
    {
        $this->paginateBy = $paginateBy;
        $this->columnLg = $columnLg;
        $this->showPaginate = $showPaginate;
        $this->showFrom = $showFrom;
        $this->valuesQuery = $valuesQuery;
    }

    public function getSellers()
    {
        return $this->baseQuery(true);
    }

    private function baseQuery($random = false, $category_id = null, $product_search = null, $seller_id = null)
    {
        //$this->sortingField = $this->sortingField ?? 'created_at';
        //$this->sortingDirection = $this->sortingDirection ?? 'DESC';

        $baseQuery =  Seller::where('status', '=', '1')
            ->where('is_approved', '=', '1')
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
