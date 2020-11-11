<?php

namespace App\Listeners;

use App\Events\CartGenerated;
use App\Events\OrderGenerated;
use App\Events\OrderPaid;
use App\Events\ProductAddedToCart;
use App\Models\CustomerLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomerLogEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handleCartGenerated($event) {
        $customerId = optional($event->cart->customer)->id;

        CustomerLog::create([
            'customer_id' => $customerId,
            'event' => 'Nuevo carrito generado',
            'json_value' => $event->cart,
        ]);
    }

    public function handleProductAddedToCart($event) {
        $customerId = optional($event->cart->customer)->id;

        CustomerLog::create([
            'customer_id' => $customerId,
            'event' => 'Producto añadido al carrito',
            'json_value' => $event->cart->toJson(),
        ]);
    }

    public function handleOrderGenerated($event) {
        $customerId = optional($event->order->customer)->id;

        CustomerLog::create([
            'customer_id' => $customerId,
            'event' => 'Nueva orden generada',
            'json_value' => $event->order->toJson(),
        ]);
    }

    public function handleOrderPaid($event) {
        $customerId = optional($event->order->customer)->id;

        CustomerLog::create([
            'customer_id' => $customerId,
            'event' => 'Nueva orden generada',
            'json_value' => $event->order->toJson(),
        ]);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            CartGenerated::class,
            [CustomerLogEventSubscriber::class, 'handleCartGenerated']
        );

        $events->listen(
            ProductAddedToCart::class,
            [CustomerLogEventSubscriber::class, 'handleProductAddedToCart']
        );

        $events->listen(
            OrderGenerated::class,
            [CustomerLogEventSubscriber::class, 'handleOrderGenerated']
        );

        $events->listen(
            OrderPaid::class,
            [CustomerLogEventSubscriber::class, 'handleOrderPaid']
        );
    }
}
