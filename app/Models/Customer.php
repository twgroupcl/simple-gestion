<?php

namespace App\Models;

use App\User;
use App\Scopes\CompanyBranchScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CustomAttributeRelations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Freshwork\ChileanBundle\Rut;

class Customer extends Model
{
    use CrudTrait;
    use CustomAttributeRelations;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_COMPANY = 1;
    const IS_NOT_COMPANY = 0;

    protected $table = 'customers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cellphone',
        'password',
        'is_company',
        'notes',
        'addresses_data',
        'activities_data',
        'banks_data',
        'contacts_data',
        'status',
        'customer_segment_id',
        'user_id',
        'json_value',
        'default_address_id',
        'company_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'addresses_data' => 'array',
        'activities_data' => 'array',
        'banks_data' => 'array',
        'contacts_data' => 'array',
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer_segment()
    {
        return $this->belongsTo(CustomerSegment::class);
    }

    public function business_activity()
    {
        return $this->belongsTo(BusinessActivity::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
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
            case $this::STATUS_ACTIVE:
                return 'Activa';
                break;
            case $this::STATUS_INACTIVE:
                return 'Inactiva';
                break;
            default:
                break;
        }
    }

    public function getIsCompanyDescriptionAttribute()
    {
        switch ($this->is_user_defined) {
            case $this::IS_COMPANY:
                return 'Jurídica';
                break;
            case $this::IS_NOT_COMPANY:
                return 'Natural';
                break;
            default:
                break;
        }
    }

    public function getFullNameAttribute()
    {
        if (!empty($this->last_name)) {
            return $this->first_name . ' ' . $this->last_name;
        }

        return $this->first_name;
    }

    public function getUidAttribute()
    {
        $rutFormatter = Rut::parse($this->attributes['uid']);

        return $rutFormatter->format();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setPasswordAttribute($value)
    {
        $attribute_name = 'password';

        $this->attributes[$attribute_name] = Hash::make($value);
    }

    public function setUidAttribute($value)
    {
        $this->attributes['uid'] = strtoupper(
            str_replace('.', '', $value)
        );
    }
}
