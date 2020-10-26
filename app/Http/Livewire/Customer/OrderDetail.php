<?php

namespace App\Http\Livewire\Customer;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;
    public $items;

    protected $listeners = ['refreshOrderDetail' => 'refresh'];

    public function render()
    {
        // dd($this->items);
        return view('livewire.customer.order-detail', [
            'order' => $this->order,
            'items' => $this->items,
        ]);
    }

    public function refresh($order_id)
    {
        $this->order = Order::find($order_id);
        $this->items = OrderItem::where('order_id', $order_id)->get();
        // dd($this->items);
    }
}
