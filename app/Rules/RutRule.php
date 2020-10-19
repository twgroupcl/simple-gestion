<?php

namespace App\Rules;

use Freshwork\ChileanBundle\Exceptions\InvalidFormatException;
use Illuminate\Contracts\Validation\Rule;
use Freshwork\ChileanBundle\Rut;

class RutRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if RUT number is valid.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return Rut::parse($value)->validate();
        } catch (InvalidFormatException $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El RUT no tiene un formato válido.';
    }
}
