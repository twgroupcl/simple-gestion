<?php

namespace App\Observers;

use App\User;
use Throwable;
use App\Models\Cart;
use App\Models\Plans;
use App\Models\Customer;
use App\Models\Currency;
use App\Models\BranchUser;
use App\Models\CompanyUser;
use Illuminate\Support\Carbon;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Backpack\Settings\app\Models\Setting;

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

    public function syncSubscription(Customer $customer)
    {

        $subscription_data = is_array($customer->subscription_data)
        ? $customer->subscription_data
        : null;

        if (!empty($subscription_data['plan_id'])) {
            $user = User::find($customer->user->id);
            $plan = app('rinvex.subscriptions.plan')->find($subscription_data['plan_id']);
            $newSubscription = $user->newSubscription('plan', $plan);
            $plan = Plans::where('id', $newSubscription->plan_id)->first();
            if ($plan->price > 0) {
                return redirect()->route('payment.subscription', ['id' => $newSubscription->id])->send();
            }
            $currency = Currency::where('id',$plan->currency)->first();
            
            $dataEmail = [
                'seller' => $customer->name,
                'plan' => $plan->name,
                'price' => $plan->price,
                'currency' => $currency->code,
                'start_date' => $subscription_data['starts_at'],
                'end_date' => $subscription_data['ends_at']
            ];
    
            $emailsAdministrator = explode(';', Setting::get('administrator_email'));
            array_push($emailsAdministrator, $customer->email);
            //$this->sendMailSuscription($dataEmail,$emailsAdministrator);
        }

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
                'logo' => asset('img/filsa-banner.jpg'),
                'title' => 'Te damos la bienvenida '.$customer->first_name,
                'text' => 'Explora la cantidad de libros que tenemos para ti.',
                'rejectedText' => '',
                'buttonText' => 'Quiero comprar',
                'buttonLink' => route('home')
            ];

            Mail::send('vendor.maileclipse.templates.welcomeCustomer', $data, function ($message) use ($customer) {
                $message->to($customer->email);
                $message->subject('Bienvenido a Prolibro S.A.');
                $message->attach(public_path('pdf/TERMINOS_Y_CONDICIONES_SITIO_WEB_FILSA.pdf'), [
                    'as' => 'TERMINOS_Y_CONDICIONES_SITIO_WEB_FILSA.pdf',
                    'mime' => 'application/pdf',
               ]);
            });

        } catch (Throwable $th) {
            logger($th->getMessage());
        }
    }
}
