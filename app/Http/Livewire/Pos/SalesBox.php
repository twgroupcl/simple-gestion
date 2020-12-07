<?php

namespace App\Http\Livewire\Pos;

use App\Models\SalesBox as ModelsSalesBox;
use Livewire\Component;

class SalesBox extends Component
{
    public $isSaleBoxOpen = false;
    public $openSaleBoxModal = false;
    public $seller;
    public $amount;
    public $remarks;

    public function render()
    {
        return view('livewire.pos.sales-box');
    }

    public function validateSaleBox()
    {
        $sale_box = $this->seller->sales_boxes()->latest()->first();

        if (null !== $sale_box) {
            $this->isSaleBoxOpen = $sale_box->closed_at !== null
                ? true
                : false;
        }

        if (! $this->isSaleBoxOpen) {
            $this->dispatchBrowserEvent('openSaleBoxModal');
        }
    }

    public function openSaleBox()
    {
        $this->seller->sales_boxes()->create([
            'open_at' => now(),
        ]);

        $this->isSaleBoxOpen = true;
    }

    public function closeSaleBox()
    {
        $this->isSaleBoxOpen = false;
    }
}
