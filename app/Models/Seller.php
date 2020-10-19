<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Scopes\CompanyBranchScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CustomAttributeRelations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Intervention\Image\ImageManagerStatic as Image;

class Seller extends Model
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

    protected $table = 'sellers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'uid',
        'name',
        'visible_name',
        'email',
        'phone',
        'cellphone',
        'web',
        'password',
        'notes',
        'addresses_data',
        'activities_data',
        'banks_data',
        'contacts_data',
        'is_approved',
        'source',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'return_policy',
        'shipping_policy',
        'privacy_policy',
        'commission_enable',
        'commission_percentage',
        'logo',
        'banner',
        'styles_json',
        'seller_category_id',
        'user_id',
        'company_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'addresses_data' => 'array',
        'activities_data' => 'array',
        'banks_data' => 'array',
        'contacts_data' => 'array',
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

    public function seller_category()
    {
        return $this->belongsTo(SellerCategory::class);
    }

    public function business_activity()
    {
        return $this->belongsTo(BusinessActivity::class);
    }

    public function addresses()
    {
        return $this->hasMany(SellerAddress::class);
    }

    public function shippingmethods()
    {
        return $this->hasMany(ShippingMethodSeller::class);
    }

    public function paymentmethods()
    {
        return $this->hasMany(PaymentMethodSeller::class);
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

    public function setPasswordAttribute($value)
    {
        $attribute_name = 'password';

        $this->attributes[$attribute_name] = Hash::make($value);
    }

    public function setLogoAttribute($value)
    {
        $attribute_name = 'logo';

        $disk = 'public';

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            $deleteFile = Str::replaceFirst('/storage/','',$this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put('logos/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            $deleteFile = Str::replaceFirst('/storage/','',$this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            $this->attributes[$attribute_name] = '/storage/logos/' . $filename;
        }
    }

    public function setBannerAttribute($value)
    {
        $attribute_name = 'banner';

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
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put('logos/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            $deleteFile = Str::replaceFirst('/storage/', '', $this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            $this->attributes[$attribute_name] = '/storage/logos/'.$filename;
        }
    }
}
