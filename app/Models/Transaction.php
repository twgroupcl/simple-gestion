<?php

namespace App\Models;

use App\Scopes\CompanyBranchScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;
    use SoftDeletes;

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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanyBranchScope);
    }


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

        return currencyFormat($amount, 'CLP');

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
    public function getPaymentOrExpenseAttribute()
    {
        return $this->transaction_type->is_payment ? "Abono" : "Gasto";
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
