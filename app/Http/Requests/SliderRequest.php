<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Rules\ImagesProductRule;
use App\Rules\SliderRule;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $imageWebRule = new SliderRule(1700,400,1500000);
        $imageMobileRule = new SliderRule(376,241,1500000);
        return [
                'name' => 'required|string',
                'path_web' => [
                    'required',
                    'string',
                    $imageWebRule],
                'path_mobile' => ['nullable',$imageMobileRule]

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'path_web' => 'Slider Web',
            'path_mobile' => 'Slider Móvil',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required*' => 'Es necesario completar el campo :attribute.',
        ];
    }
}
