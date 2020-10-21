<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SlugRule implements Rule
{
    protected $message = 'El :attribute ingresado no tiene un formato válido.';
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($message = '')
    {
        if(strlen($message))
            $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value);
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
