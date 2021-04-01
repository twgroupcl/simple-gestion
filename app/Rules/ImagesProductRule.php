<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ImagesProductRule implements Rule
{
    private $height, $width, $size, $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $w, int $h, int $size)
    {
        $this->height = $h;
        $this->width = $w;
        $this->size = $size;
        $this->message = '';
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
        if ( Str::startsWith($value, 'data:image' )){
            $image = Image::make($value);
            $this->size = $image->mime() === 'image/png' ? $this->size * 1.30 : $this->size;
            $size = (int)(strlen(rtrim($value, '=')) * 0.75);
            
            if ($size > $this->size) {
                $this->message = 'El tamaño de la imagen debe ser menor a 500 KB';
                return false;
            }

            if ( ($image->width() >= $this->width) || ($image->height() >= $this->height) ) {
                $this->message = 'Las dimensiones de la imagen no son correctas. El máximo permitido es de '. $this->width ." x " . $this->height;
                return false;
            }

            return true;
        }
        else if ( Str::contains($value, '/storage/products/') ) {
            return true;
        }
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
