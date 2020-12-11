<?php

namespace App\Http\Livewire\Pos\Report;

use App\Models\Order;
use Livewire\Component;

class PosReportView extends Component
{
    public $seller;
    public $salesBox;
    public $logs;
    public $orders;
    public $selectedOrder;

    public function render()
    {
        return view('livewire.pos.report.pos-report-view');
    }

    public function mount()
    {
        $this->salesBox = $this->seller->sales_boxes()->opened()->with('logs.order')->latest()->first();
        $this->logs = $this->salesBox->logs;
        $this->orders = $this->salesBox->logs()->whereHas('order', function($query) {
            $query->where('event', 'Nueva orden generada');
        })->get()->map(function($item) {
            return $item->order;
        });
    }

    public function selectOrder(Order $order)
    {
        $this->selectedOrder = $order;
    }
}
