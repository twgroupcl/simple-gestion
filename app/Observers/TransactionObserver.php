<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function creating(Transaction $transaction)
    {
        $company = backpack_user()->current()->company;
        $transaction->company_id = $company->id;
    }
}
