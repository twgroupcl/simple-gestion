<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\ShippingMethod;
use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class CommuneShippingMethod extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'commune_shipping_methods';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected $fakeColumns = [
        'shipping_methods',
        'active_methods',
    ];

    protected $casts = [
        'shipping_methods' => 'array',
        'json_value' => 'array',
        'active_methods' => 'array',
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

    public function getAvailableShippingMethodCodes()
    {
        $activeMethodsCode = [];
        
        if (empty($this->active_methods)) {
            return [];
        }

        $activeMethods = collect($this->active_methods)->filter(function ($value, $key) {
            return $value == 1;
        });

        foreach ($activeMethods as $code => $status) {
            array_push($activeMethodsCode, Str::replaceFirst('_status', '', $code));
        }

        return $activeMethodsCode;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
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

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getIsGlobalAccesorAttribute()
    {
        if ($this->is_global) {
            return 'Si';
        } else {
            return 'No';
        }
    }

    public function getShippingMethodsAccesorAttribute()
    {
        $availableMethods = $this->getAvailableShippingMethodCodes();
        
        $availableMethods = collect($availableMethods)->map(function ($value) {
            $shippingMethod = ShippingMethod::where('code', $value)->first();

            if (!$shippingMethod) return $value;

            return $shippingMethod->title;
        });

        return implode(", ", $availableMethods->toArray());
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
