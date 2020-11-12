<?php

namespace App\Observers;

use App\User;
use App\Models\Customer;
use App\Models\BranchUser;
use App\Models\Cart;
use App\Models\CompanyUser;
use Illuminate\Support\Carbon;
use App\Models\CustomerAddress;
use App\Models\CustomerNotification;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CustomerObserver
{
    public function creating(Customer $customer)
    {
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
        $this->syncAddresses($customer);
        $this->sendWelcomeMail($customer);
    }

    public function updated(Customer $customer)
    {
        CustomerAddress::where('customer_id', $customer->id)->delete();

        $this->syncAddresses($customer);

        if(!empty($customer->user())) {
            $customer->user()->update([
                'name' => $customer->first_name,
                'email' => $customer->email,
                'password' => $customer->password,
            ]);
        }
    }

    public function updating(Customer $customer)
    {
        $this->handleNotifications($customer);
    }

    public function syncAddresses(Customer $customer)
    {
        $addresses_data = is_array($customer->addresses_data)
            ? $customer->addresses_data
            : json_decode($customer->addresses_data, true);

        $addresses = collect($addresses_data)->map(function ($address) {
            return new CustomerAddress($address);
        });

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

    public function handleNotifications(Customer $customer)
    {
        $notifications = collect($customer->notifications_data)->map(function ($value) use ($customer) {
            return new CustomerNotification([
                'event' => 'Nueva Notificación',
                'json_value' => collect(['subject' => $value['subject'], 'message' => $value['message'],])->toJson(),
            ]);
        });

        $customer->notifications()->saveMany($notifications);
        $customer->notifications_data = null;
    }
}
