<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class ProductBrand extends Model
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

    protected $table = 'product_brands';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'name',
        'slug',
        'image',
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = 'image';

        $disk = 'public'; 
        
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            $deleteFile = Str::replaceFirst('/storage/', '', $this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()) . '.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put('brands/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            $deleteFile = Str::replaceFirst('/storage/', '', $this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            $this->attributes[$attribute_name] = '/storage/brands/' . $filename;
        }
    }
}
