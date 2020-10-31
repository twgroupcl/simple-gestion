<?php

namespace App\Observers;

use App\Mail\SellerChangeStatus;
use App\User;
use App\Models\Seller;
use App\Models\BranchUser;
use App\Models\CompanyUser;
use App\Models\SellerAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\PaymentMethodSeller;
use App\Models\ShippingMethodSeller;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Facades\Mail;

class SellerObserver
{
    public function creating(Seller $seller)
    {
        $seller->source = determineSource(request());

        if(Setting::get('seller_create_user')) {
            $user = User::create([
                'name' => $seller->name,
                'email' => $seller->email,
                'password' => $seller->password,
            ]);

            $seller->user_id = $user->id;

            $seller_role_id = Setting::get('default_seller_role');
            $seller_role = Role::find($seller_role_id)->name;

            $seller_company = CompanyUser::create([
                'user_id' => $seller->user_id,
                'company_id' => $seller->company_id,
                'role_id' => $seller_role_id,
            ]);

            if(empty(backpack_user())) {
                $branch_id = Setting::get('default_branch');
            } else {
                $branch_id = backpack_user()->current()->branch->id;
            }

            $seller_branch = BranchUser::create([
                'user_id' => $seller->user_id,
                'branch_id' => $branch_id,
                'is_default' => 1,
            ]);

            $user->assignRole($seller_role);
        }
    }

    public function created(Seller $seller)
    {
        $this->syncAddresses($seller);
        $this->syncPaymentMethods($seller);
        $this->syncShippingMethods($seller);

        if ($seller->getReviewStatus() == 'Aprobado' || $seller->getReviewStatus() == 'Rechazado') {
            Mail::to($seller)->send(new SellerChangeStatus($seller));
        }

    }

    public function updated(Seller $seller)
    {
       
        
        if ($seller->isDirty()) {
            $dirtyModel = $seller->getDirty();
            if (array_key_exists('shippings_data', $dirtyModel)) {
                $this->syncShippingMethods($seller);
            }

            if (array_key_exists('payments_data', $dirtyModel)) {
                $this->syncPaymentMethods($seller);
            }

            if (array_key_exists('addresses_data', $dirtyModel)) {
                $this->syncAddresses($seller);
            }

            if (
                array_key_exists('is_approved', $dirtyModel) && 
                ($seller->getReviewStatus() == 'Aprobado' || $seller->getReviewStatus() == 'Rechazado')
            ) {
                Mail::to($seller->email)->send(new SellerChangeStatus($seller));
            }
            if (array_key_exists('password', $dirtyModel)) {
                if(!empty($seller->user())) {
                    $seller->user()->update([
                        'name' => $seller->name,
                        'email' => $seller->email,
                        'password' => $seller->password,
                    ]);
                }
            }
        }
        
    }

    public function syncAddresses(Seller $seller)
    {
        $seller->addresses()->delete();

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

        $shippingmethods_data = is_array($request->shippings_data)
            ? $request->shippings_data
            : json_decode($request->shippings_data, true);

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

        $paymentmethods_data = is_array($request->payments_data)
            ? $request->payments_data
            : json_decode($request->payments_data, true);

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
