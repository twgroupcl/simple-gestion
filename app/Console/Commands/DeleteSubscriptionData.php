<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Seller;
use Illuminate\Console\Command;

class DeleteSubscriptionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:subscription:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar datos de suscripcion de la tienda';

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
        $sellers = Seller::where('subscription_data->ends_at',Carbon::now()->format('d/m/Y'))->get();

        foreach($sellers as $value){
            $sellerUpdate = Seller::find($value->id);
            $sellerUpdate->subscription_data = null;
            $sellerUpdate->save();
        }
    }
}
