<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const STATUS_INITIATED = 1;
    const STATUS_PAID = 2;
    const STATUS_COMPLETED = 3;

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    //protected $fillable = ['json_value'];
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
    public function getSellers()
    {
        $products_id = OrderItem::whereOrderId($this->id)->select('product_id')->with('product')->get();
        foreach($products_id as $id){
            $ids[] = $id['product_id'];
        }

        if (count($products_id)>0) {
            $sellers_id = Product::whereIn('id', $ids)->select('seller_id')->groupBy('seller_id')->get();
            return Seller::whereIn('id', $sellers_id)->select('id', 'name', 'email')->get();
        }else{
            return null;
        }


    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function order_payments()
    {
        return $this->hasMany(OrderPayment::class);
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

    public function getStatusDescriptionAttribute()
    {
        switch ($this->status) {
            case $this::STATUS_INITIATED:
                return 'Pendiente';
                break;
            case $this::STATUS_PAID:
                return 'Pagada';
                break;
            case $this::STATUS_COMPLETED:
                return 'Completa';
                break;
            default:
                break;
        }
    }

    public function getJsonValueAttribute()
    {
        $addressData = [];
        $attribute_name =  'json_value';
        $tmpAddressData = json_decode($this->attributes[$attribute_name]);
        $tmpAddressData = is_object($tmpAddressData)
                                ? $tmpAddressData
                                : json_decode($tmpAddressData);

        $item = [
            'addressShipping'=> json_decode($tmpAddressData->addressShipping),
            'addressInvoice'=> json_decode($tmpAddressData->addressInvoice),
        ];
        $addressData[]= $item;

        return $item;
    }


    public function getOrderItemsAttribute()
    {
       if (backpack_user()) {
           if (backpack_user()->hasRole('Vendedor marketplace')) {
               $items = [];
               $userSeller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
               $tmpitems = $this->order_items()->get();

               foreach ($tmpitems as $item) {
                   if ($item->product->seller_id == $userSeller->id) {
                       $items[] = $item;
                   }
               }
               return $items;
           } else {
               return $this->order_items()->get();
           }
       }else{
                return $this->order_items()->get();
       }


    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
