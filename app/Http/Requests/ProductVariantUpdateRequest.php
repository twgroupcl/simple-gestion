<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\SlugRule;
use Illuminate\Support\Str;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use App\Rules\ImagesProductRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Products\ProductVariationsRule;
use Illuminate\Http\Request as RequestHelper;

class ProductVariantUpdateRequest extends FormRequest
{

    private $prepareData = [
        'images_json',
    ];

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
            'name' => 'required|min:5|max:255',
            'sku' => [
                'required',
                Rule::unique('products')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'))->where('id', '!=', request('id'));
                }),
            ],
            'short_description' => 'required|min:5:max:150',
            'url_key' => [
                'required',
                Rule::unique('products')->where( function($query) {
                    return $query->where('id', '!=', request('id'));
                }),
                new SlugRule(),
            ],
            'seller_id' => 'required',
            'status' => 'required',
            'categories' => 'required',
            'images_json_validation.*.image' => new ImagesProductRule(1024, 1024, 700000),
            'date_of_rejected' => function ($attribute, $value, $fail) {
                $approvedStatus = RequestHelper::input('is_approved');
                if($approvedStatus === '0') {
                    if(empty($value)) return $fail('Debes indicar una fecha de rechazo');
                }
            },
            'rejected_reason' => function ($attribute, $value, $fail) {
                $approvedStatus = RequestHelper::input('is_approved');
                if($approvedStatus === '0') {
                    if(empty($value)) return $fail('Debes indicar una razon de rechazo');
                }
            },
            'special_price_from' => function ($attribute, $value, $fail) {
                $specialPrice = RequestHelper::input('special_price');
                if( !($specialPrice == 0 || is_null($specialPrice)) ) {
                    if(is_null($value)) return $fail('Debes indicar una fecha de inicio para el precio de promoción');
                }
            },
            'special_price_to' => function ($attribute, $value, $fail) {
                $specialPrice = RequestHelper::input('special_price');
                if( !($specialPrice == 0 || is_null($specialPrice)) ) {
                    if(is_null($value)) return $fail('Debes indicar una fecha de fin para el precio de promoción');
                }
            },
            'variations_json' => new ProductVariationsRule(),
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
            'name' => 'nombre',
            'sku' => 'SKU',
            'description' => 'descripcion',
            'short_description' => 'resumen',
            'url_key' => 'URL Key',
            'currency_id' => 'moneda',
            'seller_id' => 'expositor',
            'status' => 'estado',
            'categories' => 'categorias',
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

    protected function prepareForValidation()
    {
        foreach ($this->prepareData as $attrName) {
            if (empty($this->$attrName)) {
                return;
            }

            $validation = json_decode($this->$attrName);
            $forValidation = [];

            foreach ($validation as $attrs) {
                $forValidation[] = (array) $attrs;
            }

            $this->merge([
                $attrName.'_validation' => $forValidation,
            ]);
        }
    }
}
