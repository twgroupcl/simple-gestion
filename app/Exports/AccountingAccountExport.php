<?php

namespace App\Exports;

use App\Models\AccountingAccount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class AccountingAccountExport implements FromArray, WithMapping , WithHeadings
{
    protected $accountingAccounts;

    public function __construct()
    {
        $this->accountingAccounts = AccountingAccount::all(); 
    }

    public function array() : array
    {
        $accountingAccounts = [];

        return $this->accountingAccounts->load('accounting_account_type')->map(function ($accountingAccount) {
            if (isset($accountingAccount->accounting_account_type)) {
                $accountingAccount->type_name = $accountingAccount->accounting_account_type->name;
            }
            return $accountingAccount;
        })->toArray();
    }

    /**
     * Row head in document
     */
    public function headings(): array
    {
        return [
            // first row
            [
                'Código',
                'Descripcion',
                'Tipo',
                'Número',
            ],
        ];
    }

    public function map($accountingAccount): array
    {
        return [
            $accountingAccount['code'],
            $accountingAccount['name'],
            $accountingAccount['type_name'] ?? '',
            $accountingAccount['number'],
        ];
    }
}
