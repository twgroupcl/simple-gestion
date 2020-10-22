<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'carts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    private static function getInstanceCustomer(User $user, SessionManager $session) : Cart
    {
        $customer = Customer::where('user_id',$user->id)->first();

        $cart = Cart::whereCustomerId($customer->id);
        
        $sessionId = $session->getId();
        if ($cart->exists()) {
            $cart = $cart->first();
            $cart->session_id = $sessionId;

            return $cart;
        }

        /* if customer have a session but not login
        if (Cart::whereSessionId($sessionId)->exists()) {
            $cart = Cart::whereSessionId($sessionId)->first();
        } else {
            $cart = new Cart();
        }
         */

        //new cart and complete data

        $cart = new Cart();

        $cart->is_guest = false;
        $cart->session_id = Session::getId();
        $cart->customer_id = $customer->id;
        $cart->is_company = $customer->is_company;
        if ($cart->is_company) {
            $cart->business_name = $customer = $customer->first_name;
            //todo activity data ??
            $activity_data = json_decode($customer->activities_data,true);
        } else {
            $cart->first_name = $customer->first_name;
            $cart->last_name = $customer->last_name;
        }
        $addresses_data = json_decode($customer->addresses_data,true);
        if (count($addresses_data) > 0) {
            $addresses_data = $addresses_data[0];
            $cart->address_street = $addresses_data['address_street'];
            $cart->address_number = $addresses_data['address_number'];
            $cart->address_office = $addresses_data['address_subnumber'];
            $cart->address_commune_id = $addresses_data['commune_id'];
        } 

        $cart->uid = $customer->uid;
        
        $cart->email = $customer->email;
        $cart->phone = $customer->phone;
        $cart->cellphone = $customer->cellphone;
        $cart->currency_id = 1;

        return $cart;
    }
    
    private static function getInstanceGuest(SessionManager $session) : Cart
    {
        //CartModel::where('session_id', $session)->exists() ? CartModel::where('session_id', $session)->first() : new CartModel();
        $sessionId = $session->getId();
        $cart = Cart::whereSessionId($sessionId);
        if ($cart->exists()) {
            return $cart->first();
        }

        $cart = new Cart();
        $cart->session_id = $sessionId;
        $cart->is_guest = true;
        $cart->items_count = 0;
        $cart->currency_id = 1;
        return $cart;
    }

    public static function getInstance(User $user = null, SessionManager $session) : Cart
    {
        if (is_null($user)) {
            return self::getInstanceGuest($session);
        } else {
            return self::getInstanceCustomer($user, $session);
        }
    }

    public function setSessionId(string $value): void
    {
        $this->session_id = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
