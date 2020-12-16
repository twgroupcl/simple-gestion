<?php

namespace App\Models;

use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class CustomerAttendance extends Model
{
    use CrudTrait;

    protected $table = 'customer_attendances';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const CHECK_IN = 1;
    const CHECK_OUT = 2;

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getDateOnlyAttribute()
    {
        return $this->attendance_time;
    }

    public function getEntryTypeAccesorAttribute()
    {
        switch ($this->entry_type) {
            case self::CHECK_IN:
                return 'Check In';
                break;
            
            case self::CHECK_OUT:
                return 'Check Out';
                break;
        }
    }
}
