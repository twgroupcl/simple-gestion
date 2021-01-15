<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'transactions';
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
    public function getDocumentInfo()
    {
        $model = $this->document_model;
        $documentId = $this->document_identifier;

        $document = $model::find($documentId);
        $details = $document->invoice_type->name;
        if (isset($document->folio)) {
            $details .= ' F' . $document->folio;
        }
        $details .= ' ' . $document->title;

        return $details;
    }

    public function getTotalAmount()
    {
        $amount = 0;
        $amount = $this->transaction_details->sum('value');

        return $amount;

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class);
    }
    
    public function accounting_account()
    {
        return $this->belongsTo(AccountingAccount::class);
    }

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class);
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
