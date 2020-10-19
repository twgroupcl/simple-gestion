<?php

namespace App\Observers;

use App\Models\Seller;
use App\Models\SellerAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentMethodSeller;
use App\Models\ShippingMethodSeller;

class SellerObserver
{

    public function created(Seller $seller)
    {
        $this->syncAddresses($seller);
        $this->syncPaymentMethods($seller);
        $this->syncShippingMethods($seller);
    }

    public function updated(Seller $seller)
    {
        SellerAddress::where('seller_id', $seller->id)->delete();

        $this->syncAddresses($seller);
        $this->syncShippingMethods($seller);
        $this->syncPaymentMethods($seller);
    }

    public function syncAddresses(Seller $seller)
    {
        $addresses_data = is_array($seller->addresses_data)
            ? $seller->addresses_data
            : json_decode($seller->addresses_data, true);

        $addresses = collect($addresses_data)->map(function ($address) {
            return new SellerAddress($address);
        });

        $seller->addresses()->saveMany(
            $addresses
        );
    }

    public function syncShippingMethods(Seller $seller)
    {
        $seller->shippingmethods()->delete();

        $request = request();

        $shippingmethods_data = is_array($request->shippingmethods)
            ? $request->shippingmethods
            : json_decode($request->shippingmethods, true);

        $shippingmethods = collect($shippingmethods_data)->map(function ($shippingmethod) {
            if( !empty($shippingmethod['shipping_method_id'])  && strlen($shippingmethod['key']) > 0){
                return new ShippingMethodSeller($shippingmethod);
            }
        });

        // remove shippings nulls
        $shippingmethods = $shippingmethods->filter();

        if($shippingmethods->count() > 0){
            $seller->shippingmethods()->saveMany(
                $shippingmethods
            );
        }
    }

    public function syncPaymentMethods(Seller $seller)
    {
        $seller->paymentmethods()->delete();

        $request = request();

        $paymentmethods_data = is_array($request->paymentmethods)
            ? $request->paymentmethods
            : json_decode($request->paymentmethods, true);

        $paymentmethods = collect($paymentmethods_data)->map(function ($paymentmethod) {
            if( !empty($paymentmethod['payment_method_id'])  && strlen($paymentmethod['key']) > 0){
                return new PaymentMethodSeller($paymentmethod);
            }
        });

        // remove payments nulls
        $paymentmethods = $paymentmethods->filter();

        if($paymentmethods->count() > 0){
            $seller->paymentmethods()->saveMany(
                $paymentmethods
            );
        }
    }
}
