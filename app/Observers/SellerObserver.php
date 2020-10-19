<?php

namespace App\Observers;

use App\Models\Seller;
use App\Models\SellerAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SellerObserver
{

    public function created(Seller $customer)
    {
        $this->syncAddresses($customer);
    }

    public function updated(Seller $customer)
    {
        SellerAddress::where('customer_id', $customer->id)->delete();

        $this->syncAddresses($customer);
    }

    public function syncAddresses(Seller $customer)
    {
        $addresses_data = is_array($customer->addresses_data)
            ? $customer->addresses_data
            : json_decode($customer->addresses_data, true);

        $addresses = collect($addresses_data)->map(function ($address) {
            return new SellerAddress($address);
        });

        $customer->addresses()->saveMany(
            $addresses
        );
    }
}
