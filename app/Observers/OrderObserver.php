<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;

class OrderObserver
{


    public function updating(Order $order)
    {

        if ($order->isDirty()) {
            $dirtyModel = $order->getDirty();

            if (
                array_key_exists('order_items', $dirtyModel) &&
                !empty($dirtyModel['order_items'])
            ) {

                $orderItems = json_decode($dirtyModel['order_items']);
                foreach($orderItems as $item){
                    $orderitem = OrderItem::find($item->id);
                    $orderitem->shipping_status = $item->shipping_status;
                    $orderitem->update();
                }

                //Check if order is completed
                $completed = true;
                foreach($order->order_items as $item){
                    if($item->shipping_status ==1){
                        $completed = false;
                    }
                }
                if($completed){
                    $order->status = 3;
                }
            }
        }
    }


}
