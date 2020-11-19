<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING = 1;
    const STATUS_IN_REVIEW = 2;
    const STATUS_SOLVED = 3;

    const TYPE_QUESTION = 1;
    const TYPE_CLAIM = 2;
    const TYPE_SUGGESTION = 3;

    protected $table = 'customer_support';
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

    public function seller()
    {
        return $this->belongsTo(Seller::class);
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
            case $this::STATUS_PENDING:
                return 'Pendiente';
                break;
            case $this::STATUS_IN_REVIEW:
                return 'En revisión';
                    break;
            case $this::STATUS_SOLVED:
                return 'Resuelta';
                break;
            default:
                break;
        }
    }

    public function getContactTypeDescriptionAttribute()
    {
        switch ($this->contact_type) {
            case $this::TYPE_QUESTION:
                return 'Consulta';
                break;
            case $this::TYPE_CLAIM:
                return 'Reclamo';
                    break;
            case $this::TYPE_SUGGESTION:
                return 'Sugerencia';
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
}
