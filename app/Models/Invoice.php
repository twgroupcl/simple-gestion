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

    protected $table = 'invoices';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
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
