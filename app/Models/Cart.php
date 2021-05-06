<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Exception;
use Hamcrest\Arrays\IsArray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    protected $casts = [
        'json_value' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    private static function getInstanceCustomer(User $user, string $session) : Cart
    {
        $customer = Customer::where('user_id',$user->id)->first();
        
        if(!empty($customer)) {
            $cart = Cart::whereCustomerId($customer->id);

            if ($cart->exists()) {
                $cart = $cart->with('cart_items')->first();
                $cart->session_id = $session;

                return $cart;
            }

            //new cart and complete data

            $cart = new Cart();

            $cart->items_count = 0;
            $cart->items_qty = 0;
            $cart->is_guest = false;
            $cart->session_id = Session::getId();
            $cart->customer_id = $customer->id;
            $cart->currency_id = 1;
            $cart->is_company = $customer->is_company;
            $cart->company_id = 1;
            $cart->uid = '';
            $cart->total = 0;
            $cart->sub_total = 0;
        

            if ($cart->is_company) {
                $cart->business_name = $customer = $customer->first_name;
                //todo activity data ??
                $activity_data = $customer->activities_data ? 
                (is_array($customer->activities_data) ? $customer->activities_data : json_decode($customer->activities_data, true))
                : 
                null;
            } else {
                $cart->first_name = $customer->first_name;
                $cart->last_name = $customer->last_name;
            }

            $addresses_data = $customer->addresses_data ? 
                (is_array($customer->addresses_data) ? $customer->addresses_data : json_decode($customer->addresses_data, true))
                : 
                null;

            if(!empty($addresses_data) && is_array($addresses_data)) {
                if (count($addresses_data) > 0) {
                    $addresses_data = $addresses_data[0];
                    $cart->address_street = array_key_exists('address_street', $addresses_data) ? $addresses_data['address_street'] : '';
                    $cart->address_number = array_key_exists('address_number', $addresses_data) ? $addresses_data['address_number'] : '';
                    $cart->address_office = array_key_exists('address_subnumber', $addresses_data) ? $addresses_data['address_subnumber'] : '';
                    $cart->address_commune_id = array_key_exists('commune_id', $addresses_data) ? $addresses_data['commune_id'] : '';
                }
            }

            $cart->uid = $customer->uid;
            $cart->email = $customer->email;
            $cart->phone = $customer->phone;
            $cart->cellphone = $customer->cellphone;
            
            return $cart;
        }

        return self::getInstanceGuest($session);
    }

    private static function getInstanceGuest(string $session) : Cart
    {
        //CartModel::where('session_id', $session)->exists() ? CartModel::where('session_id', $session)->first() : new CartModel();
        $cart = Cart::whereSessionId($session);
        if ($cart->exists()) {
            return $cart->first();
        }

        $cart = new Cart();
        $cart->session_id = $session;
        $cart->is_guest = true;
        $cart->items_count = 0;
        $cart->items_qty = 0;
        $cart->currency_id = 1;
        $cart->company_id = 1;
        $cart->uid = '';
        $cart->first_name = '';
        $cart->last_name = '';
        $cart->phone = '';
        $cart->cellphone = '';
        $cart->total = 0;
        $cart->sub_total = 0;


        return $cart;
    }

    public static function getInstance(User $user = null, string $session) : Cart
    {
        $sessionCheck = Session::getHandler()->read($session);
        if ($sessionCheck == "") {
            //expire @todo
        }

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

    public function recalculateQtys()
    {
        unset($this->cart_items);
        $items = $this->cart_items;
        $this->items_count = $items->count();
        $itemQty = 0;
        foreach ($items as $key ) {
            $itemQty += $key->qty;
        }
        $this->items_qty = $itemQty;
    }

    public function recalculateSubtotal()
    {
        $subtotal = 0;
        unset($this->cart_items);
        foreach ($this->cart_items as $item) {
            $subtotal += $item->sub_total;
        }
        $this->sub_total = $subtotal;
    }

     /**
     * Merge cart session with cart customer. 
     *
     * @param User $user
     * @param string $sessionID
     * @return boolean result merge -> true if success
     */
    public static function mergeCart(User $user, string $sessionID): bool
    {
        $cartCustomer = self::getInstanceCustomer($user,"");
        if (Cart::whereSessionId($sessionID)->exists()) {
            DB::beginTransaction();
            try{

                $cartSession = Cart::whereSessionId($sessionID)->with('cart_items')->latest('updated_at')->first();
                $itemsSession = $cartSession->cart_items;
                $itemsCustomer = $cartCustomer->cart_items;

                if ($itemsCustomer->count() === 0) {
                    // is a new cart
                    $cartCustomer->save();
                } 

                foreach ($itemsSession as $key) {
                    $item = $itemsCustomer->where('product_id',$key->product_id)->first();

                    if($item) {
                        //item exists
                        $item->qty += $key->qty;
                        $item->updateTotals();
                        $item->update();
                        $key->delete();
                    } else {
                        //item not exists
                        $key->cart_id = $cartCustomer->id;
                        $key->update();
                    }
                }

                $cartCustomer->recalculateQtys();
                $cartCustomer->recalculateSubtotal();
                $cartCustomer->update();

-               $cartSession->delete();

               // DB::rollBack();
                DB::commit();
                return true;

            } catch (Exception $e) {
                DB::rollBack();
                return false;
            }

        }
        return true;
    }

    public function issetAddress() : bool
    {
        return isset($this->addresss_street) && isset($this->address_number) && isset($this->address_commune_id);
    }

    public function setAddress(CustomerAddress $address) : void
    {
        $this->address_street = $address->street;
        $this->address_number = $address->number;
        $this->address_office = $address->subnumber;
        $this->address_commune_id = $address->commune_id;
        $this->first_name = $address->first_name;
        $this->last_name = $address->last_name;
        $this->phone = $address->phone;
        $this->cellphone = $address->cellphone;
        $this->email = $address->email;
    }

    public function getShippingData()
    {
        return [
            'uid' => $this->uid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cellphone' => $this->cellphone,
            'address_street' => $this->address_street,
            'address_number' => $this->address_number,
            'address_office' => $this->address_office,
            'address_commune_id' => $this->address_commune_id,
            'address_details' => $this->address_details,
            'business_activity_id' => $this->business_activity_id,
            'is_company' => (bool) $this->is_company,
            'business_name' => $this->business_name,
        ];
    }

    public function getInvoiceData()
    {
        if (empty($this->invoice_value)) {
            return $this->getShippingData();
        }

        $invoice_value = json_decode($this->invoice_value, true);

        if ($invoice_value['status'] == false) {
            return $this->getShippingData();
        }

        return [
            'uid' => $invoice_value['uid'],
            'first_name' => $invoice_value['first_name'],
            'last_name' => $invoice_value['last_name'],
            'email' => $invoice_value['email'],
            'phone' => $invoice_value['phone'],
            'cellphone' => $invoice_value['cellphone'],
            'address_street' => $invoice_value['address_street'],
            'address_number' => $invoice_value['address_number'],
            'address_office' => $invoice_value['address_office'],
            'address_commune_id' => $invoice_value['address_commune_id'],
            'address_details' => $invoice_value['address_details'],
            'business_activity_id' => $invoice_value['business_activity_id'],
            'is_company' => (bool) $invoice_value['is_business'],
            'business_name' => $invoice_value['business_name'],
        ];
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
