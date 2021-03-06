<?php

namespace App\Policies;

use App\Models\{Invoice, Seller, Company};
use App\User;

class InvoicePolicy
{
    public function before($user, $ability)
    {
        if ($user->hasRole('Vendedor marketplace') || $user->hasRole('Administrador negocio')) {
            $seller = Seller::where('user_id', $user->id)->first();
            $company = $user->current()->company->id;
            $company = Company::find($company);
            if ((!empty($seller) && $seller->is_approved != Seller::STATUS_ACTIVE) || $company->status != 1){
                return false;
            }
        }
        return $user->hasRole('Super admin') ? null : null;
    }

    /**
     * execute for update event
     */
    public function update(User $user, Invoice $invoice)
    {
        //return $user->id === $post->user_id;
        return true;
    }

    public function manageInvoice(User $user, Invoice $invoice) 
    {
        //if ($user->hasRole('Vendedor marketplace') && $invoice->seller->user_id === $user->id ) {
        if ($invoice->company->id === $user->current()->company->id) {
            return true;
        }

        return false;
    }
    
    public function canCreateTempDocument(User $user, Invoice $invoice) {
        return $invoice->invoice_status == Invoice::STATUS_DRAFT;
    }

    public function doShowTempDocument(User $user, Invoice $invoice)
    {
        return $invoice->invoice_status == Invoice::STATUS_TEMPORAL;
    }

    public function doDownloadTemporalPDF(User $user, Invoice $invoice)
    {
        return $this->doShowTempDocument($user, $invoice) ||
            $invoice->invoice_status == Invoice::STATUS_TEMPORAL;
    }
    
    public function doDownloadRealPDF(User $user, Invoice $invoice)
    {
        return isset($invoice->folio) &&
                $invoice->invoice_status == Invoice::STATUS_SEND;
    }

    public function doEdit(User $user, Invoice $invoice)
    {
        $status = $invoice->invoice_status;
        return $status == Invoice::STATUS_TEMPORAL || $status == Invoice::STATUS_DRAFT;
    }

    public function doDeleteDocument(User $user, Invoice $invoice)
    {
        $status = $invoice->invoice_status;

        return $status == Invoice::STATUS_TEMPORAL;
    }

    public function showAllInvoices(User $user)
    {
        // it doesn't make sense
        return $user->hasRole('Super admin') ? true : false;
    }
}
