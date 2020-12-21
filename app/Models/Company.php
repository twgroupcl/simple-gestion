<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
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
        'uid', 'name', 'real_name', 'slug', 'logo', 'unique_hash', 'payment_data', 'dte_token', 'status',
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

    public function getBusinessAdminUsers()
    {
        $usersAdminId = DB::table('company_users')
            ->where('role_id', User::BUSINESS_ADMIN_ROL_ID)
            ->where('company_id', $this->id)
            ->get()
            ->pluck('user_id');
        
        $adminUsers = User::whereIn('id', $usersAdminId)->get();

        return $adminUsers ?: [];
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
