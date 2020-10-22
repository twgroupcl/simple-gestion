<?php

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if (! function_exists('parseCurrency')) {
    function parseCurrency($value)
    {
        if (intval($value) == $value) {
            $return = number_format($value, 0, ',', '.');
        } else {
            $return = number_format($value, 2, ',', '.');

            $return = rtrim($return, 0);
        }

        return $return;
    }
}

if (! function_exists('getNextId')) {
    function getNextId()
    {
        $user = backpack_user();

        $companyBranch = $user->current()->branch->id;

    	$statement = DB::select('SELECT MAX(estimate_number) + 1 AS next_id FROM estimates WHERE company_branch_id = ' . $companyBranch);

        if ($statement[0]->next_id == null) {
            return 1;
        }

        return $statement[0]->next_id;
    }
}

if (! function_exists('arrayToObject')) {
    function arrayToObject($array)
    {
        $obj = new stdClass;
        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = arrayToObject($v);
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    }
}

if (! function_exists('sanitizeNumber')) {
    function sanitizeNumber($number)
    {
        $number = str_replace('.', '', $number);
        $number = str_replace(',', '.', $number);

        return $number;
    }
}

if (! function_exists('currencyFormat')) {
    /**
     * Price format
     *
     * @param string $value amount
     * @param string $currency currency code (currencies table)
     * @param bool $symbol return amount with symbol or not
     * @return string price formatted
     */
    function currencyFormat(string $value, string $currency, bool $symbol = false) : string
    {
        $currency = Currency::where('code',$currency)->firstOrFail();

        $price = number_format(
            $value,
            $currency->precision,
            $currency->decimal_separator,
            $currency->thousand_separator
        );

        $price = $symbol ? $currency->symbol . $price : $price;

        return $price;
    }
}

if (! function_exists('determineSource')) {
    function determineSource(Request $request): string
    {
        if ( strpos($request->path(), 'admin/') !== false ) {
            return "Admin";
        }

        return "Front";
    }
}
