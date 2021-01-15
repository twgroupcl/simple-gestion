<?php

namespace App\Observers;

use App\Models\TransactionType;

class TransactionTypeObserver
{
    public function creating(TransactionType $transaction)
    {
        $company = backpack_user()->current()->company;
        $transaction->company_id = $company->id;

    }

}
