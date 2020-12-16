<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Request;

/**
 * Only allow numbers witch decimal separator is ","
 * 
 * Example: 1893,23
 * 
 */
class NumericCommaRule implements Rule
{
    protected $message = 'El campo :attribute debe ser un valor numerico.';
    private $min;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min = 0.01)
    {
        $this->min = $min;
    }

    /**
     *  value is not null and a postiive number
     * 
     * 
     */
    public function passes($attribute, $value)
    {
            if(is_null($value)) {
                $this->message = 'El campo :attribute debe ser un valor numerico.';
                return false;
            }

            if ( strpos($value, '.') ) {
                $this->message = 'El formato del campo :attribute solo puede tilizar la coma "," como separador decimal.';
                return false;
            }

            if ( substr_count($value, ',') > 1 ) {
                $this->message = 'El formato del campo :attribute solo puede tilizar la coma "," como separador decimal.';
                return false;
            }

            $number = sanitizeNumber($value);

            if( ! is_numeric($number) ) {
                $this->message = 'El campo :attribute debe ser un valor numerico y mayor a ' . str_replace('.', ',', $this->min) . '.';
                return false;
            }

            if($number < $this->min) {
                $this->message = 'El campo :attribute debe ser un valor numerico y mayor a ' . str_replace('.', ',', $this->min) . '.';
                return false;
            }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
