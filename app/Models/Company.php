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
    ];
    // protected $hidden = [];
    // protected $dates = [];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
}
