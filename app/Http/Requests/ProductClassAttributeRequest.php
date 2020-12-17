<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductClassAttributeRequest extends FormRequest
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
        return [
            'name' => 'required|min:1|max:255',
            'code' => [
                'required',
                Rule::unique('product_class_attributes', 'json_attributes->code')->ignore($this->id),
            ],
            'type_attribute' => 'required',
            'product_class_id' => 'required',
            'json_options' => function ($attribute, $value, $fail) {
                $options = json_decode($value);
                //dd($options);
                $typeAttribute = Request::input('type_attribute');

                // check options is not empty when typeAttribute is "select"
                if($typeAttribute == 'select') {
                    if(count($options) == 0) {
                        return $fail('Debes agregar por lo menos una opción');
                    
                    // check default options is not empty
                    } else {
                        foreach($options as $option) {
                            if($option->option_name != '') return true;
                        }
                        return $fail('Debes agregar por lo menos una opción');
                    }
                }
            },
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
            'name' => 'nombre del atributo',
            'type_attribute' => 'tipo de atributo',
            'product_class_id' => 'clase de producto',
            'options' => 'opciones',
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
            //
        ];
    }
}
