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

            $jsonValues = is_array($transaction->json_value) ? $transaction->json_value : json_decode($transaction->json_value, true);
            
            foreach ($transaction->transaction_details as $detail) {

                if (isset($detail->document_model)) {
                    $model = $detail->document_model;
                    $dte = $model::find($detail->document_identifier);    
                    $dte = $dte->description_for_select;
                } else {
                    $dte = $detail->document_identifier;
                }

                if (isset($detail->json_detail)) {
                    $metadataDetail = is_array($detail->json_detail) ? $detail->json_detail : json_decode($detail->json_detail, true);
                    $notes = $metadataDetail['notes'] ?? '';
                    $documentType = $metadataDetail['document_type'] ?? '';
                }
                $transactionArray[] = [
                    'id' => $transaction->id,
                    'value' => $detail->value,
                    'document' => $dte,
                    'document_type' => $documentType,
                    'transaction_type' => $transaction->transaction_type->name,
                    'is_payment' => $transaction->transaction_type->is_payment ? 'Abono' : 'Gasto',
                    'accounting_account_description' => $transaction->accounting_account->name ?? null,
                    'accounting_account_code' => $transaction->accounting_account->code ?? null,
                    'bank_account' => $transaction->bank_account->account_number,
                    'note' => $transaction->note,
                    'person_name_reference' => isset($jsonValues) && array_key_exists('person_name_reference', $jsonValues) ? $jsonValues['person_name_reference'] : '',
                    'person_uid_reference' => isset($jsonValues) && array_key_exists('person_uid_reference', $jsonValues) ? $jsonValues['person_uid_reference'] : '',
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
                'ID',
                'Numero de cuenta bancaria',
                'Documento',
                'Tipo de documento',
                'Monto',
                'Gasto/Abono',
                'Tipo de transaccion',
                'Descripcion plan de c.',
                'Código plan de c.',
                'Nota',
                'Fecha',
                'RUT referencia',
                'Nomb. referencia',
            ],
        ];
    }

    public function map($document): array
    {
        return [
            $document['id'],
            $document['bank_account'],
            $document['document'],
            $document['document_type'] ?? '',
            $document['value'],
            $document['transaction_type'],
            $document['is_payment'],
            $document['accounting_account_description'],
            $document['accounting_account_code'],
            $document['note'],
            $document['date'],
            $document['person_uid_reference'] ?? '',
            $document['person_name_reference'] ?? '',
        ];
    }
}
