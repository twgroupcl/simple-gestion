<?php

namespace App\Models;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Backpack\Settings\app\Models\Setting;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Company extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'companies';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'uid', 
        'name', 
        'real_name', 
        'logo', 
        'unique_hash', 
        'payment_data', 
        'status', 
        'delivery_days_min', 
        'delivery_days_max',
        'privacy_policy_path',
        'terms_and_conditions_path',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const MAIL_TO_ERRORS = [
        'tiendaonline@covepa.org',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function sendMailToAdmin(Mailable $mail)
    {
        $administrators = Setting::get('administrator_email');
        $recipients = explode(';', $administrators);

        foreach ($recipients as $key => $recipient) {
            Mail::to($recipient)->send($mail);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function inventory_sources()
    {
        return $this->hasMany(ProductInventorySource::class);
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

    public function setPrivacyPolicyPathAttribute($value)
    {
        $attribute_name = "privacy_policy_path";
        $disk = "public";
        $destination_path = "pdf";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setTermsAndConditionsPathAttribute($value)
    {
        $attribute_name = "terms_and_conditions_path";
        $disk = "public";
        $destination_path = "pdf";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        // if a new file is uploaded, delete the file from the disk
        if (request()->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = request()->file($attribute_name);
            $new_file_name = md5($file->getClientOriginalName().random_int(1, 9999).time()).'.'.$file->getClientOriginalExtension();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = 'storage/' . $file_path;
        }
    }
}
