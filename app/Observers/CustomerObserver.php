<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerObserver
{

    public function created(Customer $customer)
    {
        $this->syncAddresses($customer);
    }

    public function updated(Customer $customer)
    {
        CustomerAddress::where('customer_id', $customer->id)->delete();

        $this->syncAddresses($customer);
    }

    public function syncAddresses(Customer $customer)
    {
        $addresses_data = is_array($customer->addresses_data)
            ? $customer->addresses_data
            : json_decode($customer->addresses_data, true);

        $addresses = collect($addresses_data)->map(function ($address) {
            return new CustomerAddress($address);
        });

        $customer->addresses()->saveMany(
            $addresses
        );
    }
}
