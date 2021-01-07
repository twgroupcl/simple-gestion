<?php

namespace App\Observers;

use App\Models\BankAccount;

class BankAccountObserver
{
    public function creating(BankAccount $bankaccount)
    {
        $company = backpack_user()->current()->company;
        $bankaccount->company_id = $company->id;
    }
}
