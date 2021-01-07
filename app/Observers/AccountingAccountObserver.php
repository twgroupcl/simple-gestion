<?php

namespace App\Observers;

use App\Models\AccountingAccount;

class AccountingAccountObserver
{
    public function creating(AccountingAccount $accountaccount)
    {
        $company = backpack_user()->current()->company;
        $accountaccount->company_id = $company->id;
    }
}
