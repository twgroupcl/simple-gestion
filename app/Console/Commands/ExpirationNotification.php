<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Seller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpirationNotificationMail;

class ExpirationNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiration:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificacion de expiracion de plan';

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

        $sellers = Seller::where('subscription_data->ends_at',Carbon::now()->addDays(1)->format('d/m/Y'))->get();
        foreach($sellers as $value){
            Mail::to($value->email)->send(new ExpirationNotificationMail());
        }
    }
}
