<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const STATUS_INITIATED = 1;
    const STATUS_PAID = 2;

    protected $table = 'payments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected $fakeColumns = [
        'data_fee',
        'data_payment',
    ];
    
    protected $casts = [
        'data_fee' => 'array',
        'data_payment' => 'array',
        'data_pay' => 'array',        
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function insertDataInvoices(Invoice $invoice) : Payments
    {
        $payment = new Payments();
        $payment->invoice_id = $invoice->id;
        $payment->invoice_date = $invoice->invoice_date;
        $payment->amount_total = $invoice->total;
        $payment->save();

        return $payment;
    }

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
            case $this::STATUS_INITIATED:
                return 'Pendiente';
                break;
            case $this::STATUS_PAID:
                return 'Pagada';
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
