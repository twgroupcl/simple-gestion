<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class SalesBox extends Component
{
    public $saleBox;
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
        $this->saleBox = $this->seller->sales_boxes()->latest()->first();

        $this->isSaleBoxOpen = optional($this->saleBox)->is_opened ?? false;

        if (! $this->isSaleBoxOpen) {
            $this->dispatchBrowserEvent('openSaleBoxModal');
        } else {
            $this->emit('salesBoxUpdated', $this->saleBox->id);
        }
    }

    public function openSaleBox()
    {
        $this->saleBox = $this->seller->sales_boxes()->create([
            'amount' => $this->amount,
            'remarks' => $this->remarks,
            'opened_at' => now(),
        ]);

        $this->isSaleBoxOpen = true;
        $this->emit('salesBoxUpdated', $this->saleBox->id);
    }

    public function closeSaleBox()
    {
        $this->isSaleBoxOpen = false;
        $this->emit('salesBoxUpdated');
    }
}
