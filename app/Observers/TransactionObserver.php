<?php

namespace App\Observers;

use App\Models\{ Transaction, TransactionDetail };

class TransactionObserver
{
    public function creating(Transaction $transaction)
    {
        $company = backpack_user()->current()->company;
        $transaction->company_id = $company->id;
    }

    public function created(Transaction $transaction)
    {
        $this->syncTransactionDetails($transaction);
    }


    public function updated(Transaction $transaction)
    {
        $this->syncTransactionDetails($transaction);
    }

    public function syncTransactionDetails($transaction, $options = []) {

        if ( !empty($transaction->json_transaction_details) ) {

            TransactionDetail::where('transaction_id', $transaction->id)->delete();

            $details = is_string($transaction->json_transaction_details) ? 
                    json_decode($transaction->json_transaction_details, true) : 
                    $transaction->json_transaction_details;

            foreach($details as &$detail) {

                // Sanitize numbers
                $detail['value'] = sanitizeNumber($detail['value']);
                $props = [
                    'value' => $detail['value'],
                    'transaction_id' => $transaction->id
                ];
                TransactionDetail::create($props);
            }
        }
    }
}
