<?php

namespace App\Console\Commands;

use App\Mail\CartAbandoned;
use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AbandonedCartMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cartmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command send mails to customers with old carts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hour_interval = DB::table('settings')
                            ->select('value')
                            ->where('key', 'cart_abandoned_mail_time')
                            ->first();

        $carts = Cart::where('updated_at', '<', now()->subHours((int) $hour_interval->value))
                    ->with(['cart_items.product', 'customer'])
                    ->get();

        try {
            $customer_notifications = collect([]);

            foreach ($carts as $cart) {
                Mail::to($cart->email)->send(new CartAbandoned($cart));

                $json_value = $cart->cart_items->map(function ($item, $key) {
                    return collect($item->only(['cart_id', 'product_id', 'qty', ]))->toJson();
                });

                $customer_notifications->push([
                    'customer_id' => $cart->customer->id,
                    'event' => 'Carrito Muerto',
                    'json_value' => $json_value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('customer_notifications')->insert($customer_notifications->toArray());
        } catch (Throwable $th) {
            logger($th->getMessage());
        }
    }
}
