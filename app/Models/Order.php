<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
    const STATUS_REJECTED = 4;

    const ORDER_STATUS_WAITING_PAYMENT = 'WP';                  // Esperando pago
    const ORDER_STATUS_CONFIRMED = 'C';                   // Compra confirmada
    const ORDER_STATUS_INVOICED_DOCUMENT = 'F';           // Documento facturado
    const ORDER_STATUS_IN_PREPARATION = 'P';              // En preparación
    const ORDER_STATUS_AVAILABLE_FOR_PICKUP = 'R';        // Disponible para retiro
    const ORDER_STATUS_DISPATCHED = 'D';                  // Despachado
    const ORDER_STATUS_DELIVERED= 'E';                    // Entregado

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    //protected $fillable = ['json_value'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'json_value' => 'array',
        'pickup_person_info' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
     */
    public function getSellers()
    {
        $products_id = OrderItem::whereOrderId($this->id)->select('product_id')->with('product')->get();
        foreach ($products_id as $id) {
            $ids[] = $id['product_id'];
        }

        if (count($products_id) > 0) {
            $sellers_id = Product::whereIn('id', $ids)->select('seller_id')->groupBy('seller_id')->get();
            return Seller::whereIn('id', $sellers_id)->select('id', 'name', 'email')->get();
        } else {
            return null;
        }

    }

    public function getTotal($admin,$seller)
    {
        if($admin){

            return currencyFormat($this->total?$this->total: 0, 'CLP',true);
        }else{
            $totalOrder =  OrderItem::where('order_id', $this->id)->where('seller_id',  $seller->id)->groupBy('order_id')->sum('total');

            return currencyFormat($totalOrder?$totalOrder: 0, 'CLP',true);
        }
    }

    public function getInvoiceRut()
    {
        $addressRut = $this->uid;
        $address = $this->json_value['addressShipping'];
        $invoiceAddress = $this->json_value['addressInvoice']->status ? $this->json_value['addressInvoice'] : $address; 
        $invoiceRut = empty($invoiceAddress->uid) ?  $addressRut : $invoiceAddress->uid;
        return $invoiceRut;
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
            'address_street' => $this->json_value['addressShipping']->address_street ?? '',
            'address_number' => $this->json_value['addressShipping']->address_number ?? '',
            'address_office' => $this->json_value['addressShipping']->address_office ?? '',
            'address_commune_id' => $this->json_value['addressShipping']->address_commune_id ?? null,
            'address_details' => $this->json_value['addressShipping']->address_details ?? '',
            'business_activity_id' => $this->json_value['addressShipping']->business_activity_id ?? null,
            'is_company' => $this->is_company,
        ];
    }

    public function getInvoiceData()
    {
        if ($this->json_value['addressInvoice']->status == false) {
            return $this->getShippingData();
        }

        return [
            'uid' => $this->json_value['addressInvoice']->uid ?? '',
            'first_name' => $this->json_value['addressInvoice']->first_name ?? '',
            'last_name' => $this->json_value['addressInvoice']->last_name ?? '',
            'email' => $this->json_value['addressInvoice']->email ?? '',
            'phone' => $this->json_value['addressInvoice']->phone ?? '',
            'cellphone' => $this->json_value['addressInvoice']->cellphone ?? '',
            'address_street' => $this->json_value['addressInvoice']->address_street ?? '',
            'address_number' => $this->json_value['addressInvoice']->address_number ?? '',
            'address_office' => $this->json_value['addressInvoice']->address_office ?? '',
            'address_commune_id' => $this->json_value['addressInvoice']->address_commune_id ?? null,
            'address_details' => $this->json_value['addressInvoice']->address_details ?? '',
            'business_activity_id' => $this->json_value['addressInvoice']->business_activity_id ?? null,
            'is_company' => $this->json_value['addressInvoice']->is_business,
        ]; 
    }

    public function getOrderStatusString()
    {
        switch ($this->order_status) {
            
            case self::ORDER_STATUS_WAITING_PAYMENT:
                return 'Esperando pago';
                break;

            case self::ORDER_STATUS_CONFIRMED:
                return 'Compra confirmada';
                break;

            case self::ORDER_STATUS_INVOICED_DOCUMENT:
                return 'Documento facturado';
                break;

            case self::ORDER_STATUS_IN_PREPARATION:
                return 'En preparación';
                break;

            case self::ORDER_STATUS_AVAILABLE_FOR_PICKUP:
                return 'Disponible para retiro';
                break;

            case self::ORDER_STATUS_DISPATCHED:
                return 'Despachado';
                break;

            case self::ORDER_STATUS_DELIVERED:
                return 'Entregado';
                break;

            default:
                return 'Desconocido';
                break;
        }           
    }

    public static function orderStatusString($status)
    {
        switch ($status) {
            case self::ORDER_STATUS_WAITING_PAYMENT:
                return 'Esperando pago';
                break;
            
            case self::ORDER_STATUS_CONFIRMED:
                return 'Compra confirmada';
                break;

            case self::ORDER_STATUS_INVOICED_DOCUMENT:
                return 'Documento facturado';
                break;

            case self::ORDER_STATUS_IN_PREPARATION:
                return 'En preparación';
                break;

            case self::ORDER_STATUS_AVAILABLE_FOR_PICKUP:
                return 'Disponible para retiro';
                break;

            case self::ORDER_STATUS_DISPATCHED:
                return 'Despachado';
                break;

            case self::ORDER_STATUS_DELIVERED:
                return 'Entregado';
                break;

            default:
                return 'Desconocido';
                break;
        }           
    }

    public function getStatusHistory() : Collection
    {
        $history = DB::table('orders_status_history')->where('order_id', $this->id)->get();

        return !empty($history) ? $history : collect();
    }

    public function getShippingMethod()
    {
        if (empty($this->order_items)) {
            return null;
        }

        // Como solo puede existir un tipo de envio por orden/carrito, asumimos que el tipo de envio
        // es el envio del primer item
        $shipping = ShippingMethod::find($this->order_items->first()->shipping_id);

        if (empty($shipping)) {
            return null;
        }

        return $shipping;
    }

    public function getSeller()
    {
        // Por regla de negocio, una orden solo puede pertenecer a una sucursal, por lo tanto para
        // obtener la sucursal de la orden/carrito buscaremos el seller del primer item de la orden
        $item = $this->order_items->first();

        if (empty($item)) {
            return false;
        }

        return $item->product->seller;
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
     */

    public function scopeSearch($query, $q = null)
    {
        return $query->bySeller();
    }

    public function scopeSold($query)
    {
        return $query->whereIn('status', [self::STATUS_PAID, self::STATUS_COMPLETED]);
    }

    public function scopeBySeller($query)
    {
        if (!auth()->user() || auth()->user()->hasRole('Super admin') || auth()->user()->can('dashboard.admin')) {
            return $query;
        }

        return $query->whereHas('order_items', function ($query) {
            $query->where('seller_id', Seller::whereUserId(auth()->user()->id)->first()->id);
        });
    }

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
            case $this::STATUS_REJECTED:
                return 'Rechazada';
            default:
                break;
        }
    }

    public function getJsonValueAttribute()
    {
        if ($this->attributes) {
            $addressData = [];
            $attribute_name = 'json_value';
            $tmpAddressData = json_decode($this->attributes[$attribute_name]);
            $tmpAddressData = is_object($tmpAddressData)
            ? $tmpAddressData
            : json_decode($tmpAddressData);

            $item = [
                'addressShipping' => json_decode($tmpAddressData->addressShipping),
                'addressInvoice' => json_decode($tmpAddressData->addressInvoice),
            ];
            $addressData[] = $item;

            return $item;
        }
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
                return collect($items);
            } else {
                return $this->order_items()->get();
            }
        } else {
            return $this->order_items()->get();
        }

    }

    /*
|--------------------------------------------------------------------------
| MUTATORS
|--------------------------------------------------------------------------
 */

}
