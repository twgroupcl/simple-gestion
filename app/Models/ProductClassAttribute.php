<?php

namespace App\Models;

use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class ProductClassAttribute extends Model
{
    use CrudTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_class_attributes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'json_attributes',
        'product_class_id',
        'is_required',
        'is_configurable',
        'json_options',
        'validations',
        'company_id',
    ];

    protected $appends = ['descripcion_name'];

    protected $fakeColumns = ['json_attributes'];
    // protected $hidden = [];
    // protected $dates = [];

    protected $casts = [
        'json_attributes' => 'array',
        'json_options' => 'array',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const ATTRIBUTE_TYPE_TEXT = 'text';
    const ATTRIBUTE_TYPE_CHECKBOX = 'checkbox';
    const ATTRIBUTE_TYPE_SELECT = 'select';

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


    public function removeEmptyOptions() {
        $jsonAttributes = $this->json_attributes;
        $jsonOptions = $this->json_options;

       if($jsonAttributes['type_attribute'] != self::ATTRIBUTE_TYPE_SELECT) {
            $jsonOptions = [];
        } else {
            // remove empty options
            foreach( $jsonOptions as $key => $option ) {
                if($option['option_name'] == '') unset($jsonOptions[$key]);
            }

            $jsonOptions = array_values($jsonOptions);
        }
        $this->json_options = $jsonOptions;
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

    public function product_class() {
        return $this->belongsTo(ProductClass::class, 'product_class_id');
    }

    public function product_attributes() {
        return $this->hasMany(ProductAttribute::class,'product_class_attribute_id');
    }

    public function child_super_attributes() {
        return $this->belongsToMany(Product::class, 'product_super_attributes');
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
    public function getNameAttribute() {
        $data = $this->json_attributes;
        return $data['name'];
    }

    public function getCodeAttribute() {
        $data = $this->json_attributes;
        return $data['code'];
    }

   public function getDescripcionNameAttribute()
    {
        $data = $this->json_attributes;
        return $data['name'];
    }
    
    public function getIsRequiredTextAttribute() {
        return $this->is_required ? 'Si' : 'No';
    }

    public function getIsConfigurableTextAttribute() {
        return $this->is_configurable ? 'Si' : 'No';
    }

    public function getAttributeTypeAttribute() {
        $data = $this->json_attributes;
        switch($data['type_attribute']) {
            case self::ATTRIBUTE_TYPE_TEXT: 
                return 'Texto';
                break;
            case self::ATTRIBUTE_TYPE_CHECKBOX: 
                return 'Checkbox';
            break;
            case self::ATTRIBUTE_TYPE_SELECT: 
                return 'Selección';
            break; 
        }
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
}
