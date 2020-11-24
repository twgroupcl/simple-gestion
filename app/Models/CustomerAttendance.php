<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAttendance extends Model
{
    protected $table = 'customer_attendances';
    protected $guarded = ['id'];

    const CHECK_IN = 1;
    const CHECK_OUT = 2;

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

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
