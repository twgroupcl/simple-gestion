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

    protected $table = 'invoices';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
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
        'customer_id',
        'currency_id',
        'customer_business_activity_id',
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
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fakeColumns = [
        'json_value',
    ];

    protected $casts = [
        'items_data' => 'array',
        'json_value' => 'array'
    ];

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

    public function invoice_type()
    {
        return $this->belongsTo(InvoiceType::class);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class);
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
