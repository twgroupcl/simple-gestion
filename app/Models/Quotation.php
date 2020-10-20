<?php

namespace App\Models;

use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Quotation extends Model
{
    use CrudTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const STATUS_DRAFT = 'BORRADOR';
    const STATUS_SENT = 'ENVIADO';
    const STATUS_VIEWED = 'VISTO';
    const STATUS_EXPIRED = 'EXPIRADO';
    const STATUS_ACCEPTED = 'ACEPTADO';
    const STATUS_REJECTED = 'RECHAZADO';

    protected $table = 'quotations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'title',
        'quotation_date',
        'expiry_date',
        'customer_id',
        'seller_id',
        'uid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cellphone',
        'is_company',
        'preface',
        'notes',
        'include_payment_data',
        'email_sent',
        'discount_percent',
        'discount_amount',
        'items_count',
        'items_qty',
        'currency_id',
        'has_discount_per_item',
        'has_tax_per_item',
        'unique_hash',
        'discount_total',
        'sub_total',
        'net',
        'total',
        'tax_percent',
        'tax_amount',
        'tax_total',
        'tax_specific',
        'quotation_status',
        'items_data',
        'json_value',
        'status',
        'business_activity_id',
        'address_id',
        'branch_id',
    ];
    // protected $hidden = [];
    protected $dates = [
        'quotation_date',
        'expiry_date',
    ];
    protected $casts = [
        'items_data' => 'array',
        'json_value' => 'array',
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

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function quotation_items()
    {
        return $this->hasMany(QuotationItem::class);
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

    public function getIdAccesorAttribute()
    {
        return $this->id;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
