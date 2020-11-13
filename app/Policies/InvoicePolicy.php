<?php

namespace App\Policies;

use App\Models\Invoice;
use App\User;

class InvoicePolicy
{
    //public function before($user, $ability)
    //{
    //    return $user->hasRole('Super admin') ? null : null;
    //}

    /**
     * execute for update event
     */
    public function update(User $user, Invoice $invoice)
    {
        //return $user->id === $post->user_id;
        return true;
    }
    
    public function canCreateTempDocument(User $user, Invoice $invoice) {
        return $invoice->invoice_status == Invoice::STATUS_DRAFT;
    }

    public function doShowTempDocument(User $user, Invoice $invoice)
    {
        return $invoice->invoice_status == Invoice::STATUS_TEMPORAL;
    }

    public function showAllInvoices(User $user)
    {
        // it doesn't make sense
        return $user->hasRole('Super admin') ? true : false;
    }
}
