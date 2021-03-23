<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefundItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'refund_items';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function refund()
    {
        return $this->belongsTo(Refund::class);
    }
}
