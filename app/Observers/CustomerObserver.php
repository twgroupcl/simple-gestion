<?php

namespace App\Observers;

use App\User;
use App\Models\Customer;
use App\Models\BranchUser;
use App\Models\Cart;
use App\Models\CompanyUser;
use Illuminate\Support\Carbon;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CustomerObserver
{
    public function creating(Customer $customer)
    {
        $password = strtoupper(str_replace('.', '', $customer->uid));

        $customer->password = $password;
        if(Setting::get('customer_create_user')) {
            $user = User::create([
                'name' => $customer->first_name,
                'email' => $customer->email,
                'password' => $customer->password,
            ]);

            $customer->user_id = $user->id;

            $customer_role_id = Setting::get('default_customer_role');
            $customer_role = Role::find($customer_role_id)->name;

            $customer_company = CompanyUser::create([
                'user_id' => $customer->user_id,
                'company_id' => $customer->company_id,
                'role_id' => $customer_role_id,
            ]);

            if(empty(backpack_user())) {
                $branch_id = Setting::get('default_branch');
            } else {
                $branch_id = backpack_user()->current()->branch->id;
            }

            $customer_branch = BranchUser::create([
                'user_id' => $customer->user_id,
                'branch_id' => $branch_id,
                'is_default' => 1,
            ]);

            $user->assignRole($customer_role);
        }
    }

    public function created(Customer $customer)
    {
        $this->syncAddressesWithoutDeleting($customer, true);
        $this->sendWelcomeMail($customer);
    }

    public function updating(Customer $customer)
    {
        $this->syncAddressesWithoutDeleting($customer);
    }

    public function updated(Customer $customer)
    {
        //CustomerAddress::where('customer_id', $customer->id)->delete();

        //$this->syncAddresses($customer);

        if(!empty($customer->user())) {
            $customer->user()->update([
                'name' => $customer->first_name,
                'email' => $customer->email,
                'password' => $customer->password,
            ]);
        }
    }

    public function syncAddressesWithoutDeleting(Customer $customer, $update = false)
    {
        $addresses_data = is_array($customer->addresses_data)
            ? $customer->addresses_data
            : json_decode($customer->addresses_data, true);

        $originalAddresses =  $customer->getOriginal('addresses_data');

        if (!is_null($originalAddresses)) {
            $originalAddressesId = collect($originalAddresses)->pluck('customer_address_id')->toArray();
            $actualAddressesId = collect($addresses_data)->pluck('customer_address_id')->toArray();

            foreach($originalAddressesId as $originalId) {
                if (empty($originalId)) continue;

                if (!in_array($originalId, $actualAddressesId)) {
                    CustomerAddress::find($originalId)->delete();
                }
            }
        }

        foreach($addresses_data as &$address) {
            if ($address['customer_address_id'] == '') {
                $newAddress = $customer->addresses()->create($address);
                $address['customer_address_id'] = $newAddress->id;
            } else {
                CustomerAddress::find($address['customer_address_id'])->update($address);
            }
        }

        $customer->addresses_data = $addresses_data;
        if ($update) $customer->update();
    }

    public function syncAddresses(Customer $customer)
    {
        $addresses_data = is_array($customer->addresses_data)
            ? $customer->addresses_data
            : json_decode($customer->addresses_data, true);

        $addresses = collect($addresses_data)->map(function ($address) {
            return new CustomerAddress($address);
        });

        // TODO move this to the new sync method
        if (CustomerAddress::whereCustomerId($customer->id)->count() > 0) {
            $cart = Cart::whereCustomerId($customer->id)->first();

            if($cart && !$cart->issetAddress()) {
                $cart->setAddress($addresses->first());
                $cart->update();
            }
        }

        $customer->addresses()->saveMany(
            $addresses
        );
    }

    public function sendWelcomeMail(Customer $customer)
    {
        try {
            $data = [
                'logo' => asset('img/logo-pyme.png'),
                'title' => 'Te damos la bienvenida '.$customer->first_name,
                'text' => 'Explora la cantidad de productos que tenemos para ti.',
                'rejectedText' => '',
                'buttonText' => 'Quiero comprar',
                'buttonLink' => route('index')
            ];

            Mail::send('vendor.maileclipse.templates.welcomeCustomer', $data, function ($message) use ($customer) {
                $message->to($customer->email);
                $message->subject('Bienvenido a Contigo Pyme');
            });

        } catch (Throwable $th) {
            logger($th->getMessage());
        }
    }
}