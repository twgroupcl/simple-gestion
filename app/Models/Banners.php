<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Banners extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'banners';
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
                return 'Activo';
                break;
            case $this::STATUS_INACTIVE:
                return 'Inactivo';
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
    public function setPathWebAttribute($value)
    {
        $attribute_name = 'path_web';

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
            \Storage::disk($disk)->put('banner-home/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            $deleteFile = Str::replaceFirst('/storage/', '', $this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            $this->attributes[$attribute_name] = '/storage/banner-home/'.$filename;
        }
    }

    public function setPathMobileAttribute($value)
    {
        $attribute_name = 'path_mobile';

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
            \Storage::disk($disk)->put('banner-home/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            $deleteFile = Str::replaceFirst('/storage/', '', $this->{$attribute_name});
            \Storage::disk($disk)->delete($deleteFile);

            $this->attributes[$attribute_name] = '/storage/banner-home/'.$filename;
        }
    }


}
