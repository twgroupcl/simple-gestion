<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{
    Customer, 
    InvoiceType,
    CustomerAddress, 
    Seller, 
    Branch, 
    InvoiceItem, 
    Tax
};

class Invoice extends Model
{
    use CrudTrait;
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const STATUS_DRAFT = 'draft';
    const STATUS_TEMPORAL = 'temporal';
    const STATUS_SEND = 'send';
    const PAYMENT_CASH = 1;
    const PAYMENT_CREDIT = 2;
    const FOREIGN_RUT = '55555555-5';

    protected $table = 'invoices';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'customer_id',
        'currency_id',
        'customer_business_activity_id',
        'business_activity_id', // idem customer_business_activity_id
        'company_id',
        'uid',
        'first_name',
        'last_name',
        //'address_data',
        //'prepare_address',
        'address_id',
        'email',
        'email_sent',
        'invoice_type_id',
        'invoice_date',
        //'invoice_status',
        'is_company',
        'items_count',
        'include_payment_data',
        'items_data',
        'items_qty',
        'json_value',
        'phone',
        'cellphone',
        'notes',
        'net',
        'preface',
        'has_discount_per_item',
        'has_tax_per_item',
        'folio',
        'discount_amount',
        'discount_percent',
        'discount_total',
        //'dte_code',
        'expiry_date',
        'payment_method',
        'seller_business_activity_id',
        'seller_id',
        //'status',
        'sub_total',
        'tax_amount',
        'tax_percent',
        'tax_specific',
        'tax_total',
        //'tax_type',
        'title',
        'total',
        'bank_id',
        'bank_account_type_id',
        'bank_number_account',
        'way_to_payment',
        'dte_status',
        'impact_inventory',
    ];
    public function getToStringAttribute()
    {
        return $this->invoice_type->name . ' - ' . $this->title . ' (' . $this->folio . ')';
    }
    // protected $hidden = [];
    // protected $dates = [];
    protected $fakeColumns = [
        'json_value',
    ];

    protected $casts = [
        'items_data' => 'array',
        'json_value' => 'array',
        'dte_status' => 'array',
       // 'address_data' => 'array',
    ];

    protected $appends = ['description_for_select'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyBranchScope);
    }

    public function updateWithoutEvents(array $options=[])
    {
        return static::withoutEvents(function() use ($options) {
            return $this->update($options);
        });
    }

    /**
     * Set status invoice to draft
     */
    public function toDraft()
    {
        $this->invoice_status = self::STATUS_DRAFT;
        $this->dte_code = null;
    }

    /**
     * Get model Invoice from array
     * @param array $array
     * @return Invoice
     */
    public static function toObject($array) : Invoice
    {
        $invoice = new Invoice($array);
        $invoice->dte_code = $array['dte_code'];
        return $invoice;
    }

    /**
     * Reduce the inventory of every product in the invoice
     * 
     * @throws Exception the method updateInventory could throw exceptions 
     */
    public function reduceInventoryOfItems()
    {
        if (!$this->invoice_items->count()) return true;

        foreach ($this->invoice_items as $item) {
            if ($item->product_id) {
                if (!$inventory = $item->product->inventories->first()) continue;

                $qtyOnStock = $item->product->getQtyInInventory($inventory->id);
                $newTotal = $qtyOnStock - $item->qty;
                $item->product->updateInventory($newTotal, $inventory->id);
            }
        }

        return true;
    }

    /**
     * Increment the inventory of every product in the invoice
     * 
     * @throws Exception the method updateInventory could throw exceptions 
     */
    public function incrementInventoryOfItems()
    {
        if (!$this->invoice_items->count()) return true;

        foreach ($this->invoice_items as $item) {
            if ($item->product_id) {
                if (!$inventory = $item->product->inventories->first()) continue;
                $qtyOnStock = $item->product->getQtyInInventory($inventory->id);
                $newTotal = $qtyOnStock + $item->qty;
                $item->product->updateInventory($newTotal, $inventory->id);
            }
        }

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class)->withTrashed();
    }

    public function invoice_type()
    {
        return $this->belongsTo(InvoiceType::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function bank_account_type()
    {
        return $this->belongsTo(BankAccountType::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'invoice_order');
    }

    public function business_activity()
    {
        return $this->belongsTo(BusinessActivity::class);
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
     * DEPRECATED 
    public function getPrepareAddressAttribute()
    {
        $customerAddress = json_decode($this->address_data, true);
        if (is_array($customerAddress)) {
            return $customerAddress['id'];
        }
        return null;
    }*/

    public function getDescriptionForSelectAttribute()
    {
        $string = '';

        if (isset($this->title)) {
            $string = $this->title . ' - ';
        }

        $string .=  $this->invoice_type->name . ' - ' . currencyFormat($this->total, 'CLP', true);

        return $string;

    }

    public function getOrderAttribute()
    {
        return $this->orders->first();
    }

    public function getStatusDescriptionAttribute()
    {
        switch ($this->invoice_status) {
            case self::STATUS_DRAFT:
                return 'Borrador';
                break;
            case self::STATUS_TEMPORAL:
                return 'Doc. Temporal';
                break;
            case self::STATUS_SEND:
                return 'Doc. Enviado';
                break;
            default:
                break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
     */

    /*public function setPrepareAddressAttribute($id)
    {
        $customerAddress = CustomerAddress::find($id);
        $this->address_data = json_encode($customerAddress->toArray());
    }*/

}
