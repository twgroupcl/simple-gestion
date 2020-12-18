<?php

namespace App\Http\Livewire\Pos\Report;

use App\Models\Order;
use Livewire\Component;

class PosReportView extends Component
{
    public $seller;
    public $salesBox;
    public $logs = [];
    public $orders = [];
    public $selectedOrder;
    public $search;
    protected $listeners = [
        'sales.updateOrders' => 'updateOrders',
    ];
    public function render()
    {
        return view('livewire.pos.report.pos-report-view');
    }

    public function mount()
    {
        $this->salesBox = $this->seller->sales_boxes()->opened()->with('logs.order')->latest()->first();

        if ($this->salesBox) {
            $this->logs = $this->salesBox->logs;
        }
        // $this->orders = $this->salesBox->logs()->whereHas('order', function($query) {
        //     $query->where('event', 'Nueva orden generada');
        // })->get()->map(function($item) {
        //     return $item->order;
        // });
        $this->updateOrders();
    }

    public function selectOrder(Order $order)
    {
        $this->selectedOrder = $order;
    }

    public function updatedSearch()
    {
        $this->filter();
    }

    public function filter()
    {
        $this->orders = $this->salesBox->logs()->whereHas('order', function ($query) {
            $query->where('id', 'LIKE', "%{$this->search}%");
        })->limit(10)
            ->get()->map(function ($item) {
            return $item->order;
        });
    }

    public function updateOrders()
    {
        if ($this->salesBox) {
            $this->orders = $this->salesBox->logs()->whereHas('order', function ($query) {
                $query->where('event', 'Nueva orden generada');
            })->latest()->limit(10)->get()->map(function ($item) {
                return $item->order;
            });
        }
    }
}
