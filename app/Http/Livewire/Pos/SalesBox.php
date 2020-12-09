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

    protected $rules = [
        'amount' => 'required|int',
        'remarks' => 'nullable',
    ];

    protected $messages = [
        'required' => 'Este monto es obligatorio',
        'int' => 'El monto debe ser número',
    ];

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
        $this->validate();
        $this->saleBox = $this->seller->sales_boxes()->create([
            'amount' => $this->amount,
            'remarks' => $this->remarks,
            'opened_at' => now(),
        ]);

        $this->isSaleBoxOpen = true;
        $this->emit('salesBoxUpdated', $this->saleBox->id);
        $this->dispatchBrowserEvent('closeSaleBoxModal');
    }

    public function closeSaleBox()
    {
        $this->isSaleBoxOpen = false;
        $this->emit('salesBoxUpdated');
        $this->dispatchBrowserEvent('closeSaleBoxModal');
    }
}
