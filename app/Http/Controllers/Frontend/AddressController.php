<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddressRequest;
use App\Models\Customer;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(AddressRequest $request, Customer $customer)
    {
        $validatedData = $request->validated();

        foreach ($validatedData as $key => $value) {
            if ($value === null) {
                $validatedData[$key] = '';
            }
        }

        $addresses_data = is_array($customer->addresses_data)
                    ? $customer->addresses_data
                    : json_decode($customer->addresses_data, true) ?? [];

        array_push($addresses_data, $validatedData);

        $str = json_encode($addresses_data, true);

        $customer->update([
            'addresses_data' => $str,
        ]);

        return redirect()->back();
    }
}
