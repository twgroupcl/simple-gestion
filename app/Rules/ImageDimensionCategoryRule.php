<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ImageDimensionCategoryRule implements Rule
{
    private $height, $width;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $w, int $h)
    {
        $this->height = $h;
        $this->width = $w;
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
            return ($image->width() <= $this->width) && ($image->height() <= $this->height);
        }
        else if ( Str::contains($value, '/storage/categories/') ) {
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
        return 'Las dimensiones de la imagen no son correctas. El máximo permitido es de '. $this->width ." x " . $this->height;
    }
}
