<?php

namespace App\Models;

use App\User;
use DateTime;
use Freshwork\ChileanBundle\Rut;
use App\Scopes\CompanyBranchScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomAttributeRelations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

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
        'is_foreign',
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

    protected $hidden = [
        'password',
    ];

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

    public function registerAttendance(int $companyId, $serviceId = null)
    {
        $todayAttendances = CustomerAttendance::whereDay('attendance_time', date('d'))->where('customer_id', $this->id)->get();
        $entryNumber = $todayAttendances->count() + 1;
        $entryType = ($entryNumber % 2) ? CustomerAttendance::CHECK_IN : CustomerAttendance::CHECK_OUT;

        $attendance = CustomerAttendance::create([
            'attendance_time' => new DateTime(),
            'entry_number' => $entryNumber,
            'entry_type' => $entryType,
            'service_id' => $serviceId,
            'customer_id' => $this->id,
            'branch_id' => $this->user->branches->first()->id,
            'company_id' => $companyId,
        ]);

        return $attendance;
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

    public function addresses_with_deletes()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'id')->withTrashed();
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function attendances()
    {
        return $this->hasMany(CustomerAttendance::class);
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
        switch ($this->is_company) {
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
        if ($this->is_foreign) return $this->attributes['uid'];

        $rutFormatter = Rut::parse($this->attributes['uid']);

        return $rutFormatter->format();
    }

    public function getCustomerSegmentNameAttribute()
    {
        return $this->customer_segment->name ?? '';
    }

    public function getAddressesDataFirstStreetAttribute()
    {
        $firstStreet = null;
        $firstAddress = $this->addresses()->first();

        if (!is_null($firstAddress)) {

            $firstStreet = $firstAddress->street;

        }
        return $firstStreet;
    }

    public function getAddressesDataFirstNumberAttribute()
    {
        $firstNumber = null;
        $firstAddress = $this->addresses()->first();

        if (!is_null($firstAddress)) {

            $firstNumber = $firstAddress->number;

        }
        return $firstNumber;
    }
    public function getAddressesDataFirstSubNumberAttribute()
    {
        $firstSubNumber = null;
        $firstAddress = $this->addresses()->first();

        if (!is_null($firstAddress)) {

            $firstSubNumber = $firstAddress->subnumber;

        }
        return $firstSubNumber;
    }
    public function getAddressesDataFirstCommuneAttribute()
    {
        $communeName = null;
        $firstAddress = $this->addresses()->first();

        if (!is_null($firstAddress)) {
            if (isset($firstAddress->commune)) {
                $communeName = $firstAddress->commune->name;
            }
        }
        return $communeName;
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
        if ($this->is_foreign) {
            $this->attributes['uid'] = $value;
            return true;
        }

        $this->attributes['uid'] = strtoupper(
            str_replace('.', '', $value)
        );
    }
}
