<?php

namespace App\Services;

use App\Models\OrderLog;

class OrderLoggerService
{
    public function registerLog($order, $event, $data)
    {
        $orderlog = new OrderLog();
        $orderlog->order_id = $order->id;
        $orderlog->event = $event;
        $orderlog->json_value = json_encode($data);
        $orderlog->save();
    }
}
