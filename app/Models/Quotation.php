<?php

namespace App\Models;

use Carbon\Carbon;
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
    const STATUS_ISSUED = 'EMITIDO';
    const STATUS_INVOICED = 'FACTURADO';

    // Special status for recurring quotations
    const STATUS_COMPLETED = 'COMPLETADO';
    const STATUS_CANCELED = 'CANCELADO';
    const STATUS_PENDING_PAYMENT = 'PAGO_PENDIENTE';

    protected $table = 'quotations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'reference',
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
        'tax_type',
        'tax_specific',
        'quotation_status',
        'items_data',
        'json_value',
        'status',
        'business_activity_id',
        'address_id',
        'branch_id',
        'invoice_type_id',
        'is_recurring',
        'recurring_data',
    ];

    // protected $hidden = [];
    protected $dates = [
        'quotation_date',
        'expiry_date',
    ];
    protected $casts = [
        'items_data' => 'array',
        'json_value' => 'array',
        'recurring_data' => 'array',
    ];

    protected $fakeColumns = [
        'recurring_data',
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

    public static function datePrefix()
    {
        $date = new Carbon();
        $prefix = $date->format('Ym');
        return $prefix;
    }

    public function updateWithoutEvents(array $options=[])
    {
        return static::withoutEvents(function() use ($options) {
            return $this->update($options);
        });
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
        return $this->belongsTo(CustomerAddress::class)->withTrashed();
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

    public function parent()
    {
        return $this->belongsTo(Quotation::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Quotation::class, 'parent_id');
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

    public function getCodeAccesorAttribute()
    {
        return $this->code;
    }

    public function getCustomerWithUidAttribute()
    {
        return $this->customer->fullNameWithUid;
    }

    public function getCodeWithPrefixAttribute()
    {
        $date = new Carbon($this->quotation_date);
        $prefix = $date->format('Ym');
        return $prefix . $this->code;
    }

    public function getIsRecurringAccesorAttribute()
    {
        if ($this->is_recurring) {
            return 'Si';
        } else {
            return 'No';
        }
    }

    public function getQuotationStatusTextAttribute() 
    {
        switch ($this->quotation_status) {
            case self::STATUS_DRAFT: 
                return 'Borrador';
                break;
            case self::STATUS_REJECTED:
                return 'Rechazada';
                break;
            case self::STATUS_ACCEPTED:
                return 'Aceptada';
                break;
            case self::STATUS_EXPIRED:
                return 'Expirada';
                break;
            case self::STATUS_VIEWED:
                return 'Vista';
                break;
            case self::STATUS_SENT:
                return 'Enviada';
                break;
            case self::STATUS_ISSUED;
                return 'Emitida';
                break;
            case self::STATUS_INVOICED;
                return 'Facturada';
                break;
            case self::STATUS_PENDING_PAYMENT;
                return 'Pago pendiente';
                break;
            case self::STATUS_COMPLETED;
                return 'Completada';
                break;
            case self::STATUS_CANCELED;
                return 'Cancelada';
                break;
            default: 
                return 'Otro';
                break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
