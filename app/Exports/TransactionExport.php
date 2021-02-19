<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class TransactionExport implements FromArray, WithMapping , WithHeadings
{
    protected $transactions;

    public function __construct()
    {
        $this->transactions = Transaction::all(); 
    }

    public function array() : array
    {
        $transactions = [];

        return $this->transactions->map(function ($transaction) {
            $transactionArray = [];

            foreach ($transaction->transaction_details as $detail) {

                if (isset($detail->document_model)) {
                    $model = $detail->document_model;
                    $dte = $model::find($detail->document_identifier);    
                    $dte = $dte->description_for_select;
                } else {
                    $dte = $detail->document_identifier;
                }

                $transactionArray[] = [
                    'value' => $detail->value,
                    'document' => $dte,
                    'transaction_type' => $transaction->transaction_type->name,
                    'is_payment' => $transaction->transaction_type->is_payment ? 'Abono' : 'Gasto',
                    'accounting_account_description' => $transaction->accounting_account->name ?? null,
                    'accounting_account_code' => $transaction->accounting_account->code ?? null,
                    'bank_account' => $transaction->bank_account->account_number,
                    'note' => $transaction->note,
                    'date' => $transaction->date,
                ];
            }
            return $transactionArray;

        })->flatten(1)->toArray();
    }

    /**
     * Row head in document
     */
    public function headings(): array
    {
        return [
            // first row
            [
                'Numero de cuenta bancaria',
                'Documento',
                'Monto',
                'Gasto/Abono',
                'Tipo de transaccion',
                'Descripcion plan de c.',
                'Código plan de c.',
                'Nota',
                'Fecha',
            ],
        ];
    }

    public function map($document): array
    {
        return [
            $document['bank_account'],
            $document['document'],
            $document['value'],
            $document['transaction_type'],
            $document['is_payment'],
            $document['accounting_account_description'],
            $document['accounting_account_code'],
            $document['note'],
            $document['date'],
        ];
    }
}
