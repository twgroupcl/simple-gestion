<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderUpdated;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function updated(Order $order)
    {
        if ($order->isDirty()) {
            if ($order->status == 3) {
                Mail::to($order->email)->send(new OrderUpdated($order, 1, null));
            }
        }
    }
    public function updating(Order $order)
    {

        if ($order->isDirty()) {

            $dirtyModel = $order->getDirty();

            if (
                array_key_exists('order_items', $dirtyModel) &&
                !empty($dirtyModel['order_items'])
            ) {

                $shippingOrderItems = json_decode($dirtyModel['order_items']);

                foreach ($shippingOrderItems as $orderItems) {
                    $orderItems = json_decode($orderItems);
                    foreach ($orderItems as $key => $item) {
                        $orderitem = OrderItem::find($item->id);
                        $orderitem->shipping_status = $item->shipping_status;
                        $orderitem->update();
                        // if ($item->shipping_status == 1) {
                        //     $completed = false;
                        // }
                    }

                }

                //Check if order is completed
                $completed = true;
                $orderItems = $order->order_items()->get();
                foreach ($orderItems as $orderKey => $orderItem) {

                    if ($orderItem->shipping_status == 1) {
                        $completed = false;

                    }

                }

                //If the order is paid and all items were shipped from update the order to Complete
                if ($completed) {

                    if ($order->status == 2) {
                        $order->status = 3;

                    }
                }
            }
        }
    }

}
