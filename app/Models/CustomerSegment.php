<?php

namespace App\Models;

use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class CustomerSegment extends Model
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

    const USER_DEFINED = 1;
    const USER_NOT_DEFINED = 0;

    protected $table = 'customer_segments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'is_user_defined',
        'status',
        'company_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];

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

    public function getIsUserDefinedDescriptionAttribute()
    {
        switch ($this->is_user_defined) {
            case $this::USER_DEFINED:
                return 'Si';
                break;
            case $this::USER_NOT_DEFINED:
                return 'No';
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
}
