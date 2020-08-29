<?php

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
