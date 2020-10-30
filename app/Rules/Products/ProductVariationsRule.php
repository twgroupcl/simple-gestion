<?php

namespace App\Rules\Products;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Rules\NumericCommaRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as RuleFacade;
use Illuminate\Validation\Rule as RuleMethods;

class ProductVariationsRule implements Rule
{

    private $message = '';
    private $attributes;
    private $messageErrors;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->attributes = [
            'price' => 'precio',
            'width' => 'ancho',
            'height' => 'alto',
            'depth' =>  'largo',
            'weight' => 'peso',
            'special_price'  => 'precio de oferta',
            'special_price_from' => 'fecha de inicio de oferta',
            'special_price_to' => 'fecha de fin de oferta',
        ];

        $this->messages = [
            '*.required*' => 'Es necesario completar el campo :attribute.',
            '*.after' => 'El campo :attribute debe ser una fecha posterior a :date.',
        ];
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
        $variations = json_decode($value);

        if (count($variations) < 1) {
            $this->message = 'Debes agregar por lo menos una variacion';
            return false;
        }

        // Check for duplicate SKU
        /* $skuDuplicates = collect($variations)->pluck('sku')->push(request('sku'))->duplicates();
        if ( count($skuDuplicates) ) {
            $this->message = 'El SKU de cada variacion debe ser unico.';
            return false;
        } */

        // Validate base fields
        foreach ($variations as $key => $variant) {

            $fieldGroupValidator = Validator::make((array) $variant, 
            [
                'price'  => ['required', new NumericCommaRule()],
                'width'  => ['sometimes', 'required', new NumericCommaRule()],
                'height'  => ['sometimes', 'required', new NumericCommaRule()],
                'depth'  => ['sometimes', 'required', new NumericCommaRule()],
                'weight'  => ['sometimes', 'required', new NumericCommaRule()],
                'special_price'  => new NumericCommaRule(),
                /* 'special_price_from' => RuleMethods::requiredIf($variant->special_price > 1),
                'special_price_to' => [RuleMethods::requiredIf($variant->special_price > 1), 'after:special_price_from'], */

            ], $this->messages, $this->attributes);


            if ($fieldGroupValidator->fails()) {
                $this->message = 'Hay un error en tu variacion. '  . $fieldGroupValidator->errors()->first();
                return false;
            }

            // Validate unique SKU on DB
            /* if ($variant->product_id != '') {
                $result = Product::where('seller_id', '=',  request('seller_id'))->where('id', '!=', $variant->product_id)->where('sku', '=', $variant->sku);
                if ( $result->count() ) {
                    $this->message = 'El SKU que intentas usar en tu variacion ya se encuentra en uso.';
                    return false;
                }
            } else {
                $result = Product::where('seller_id', '=',  request('seller_id'))->where('sku', '=', $variant->sku);
                if ( $result->count() ) {
                    $this->message = 'El SKU que intentas usar en tu variacion ya se encuentra en uso.';
                    return false;
                }
            } */

            // Validate inventories fields
            $product = new Product();
            $inventoriesArray = $product->getInventoriesArrayFromVariation($variant);
            
            foreach ($inventoriesArray as $key => $qty) {
                if ($qty == "" || is_null($qty)) {
                    $this->message = 'Debes indicar la cantidad en inventario en cada variante';
                    return false;
                } else if ($qty < 0 ) {
                    $this->message = 'La cantidad en inventario no puede ser negativa';
                    return false;
                }
            }
        }

        // Validate attributes fields
        // First we extract his attributes
        $variantAttributes = [];
        $variantCount = 0;
        foreach($variations as $variant) {
            $variantCount++;
            foreach($variant as $param => $value) {
                // get id and values of every attribute
                $isAnAtributte = substr($param, 0, 15) == 'super-attribute'; 
                if($isAnAtributte) {
                    $variantAttributes[$variantCount][] = [
                        'id' =>  Str::replaceFirst('super-attribute-', '', $param),
                        'value' => $value,
                    ];
                }
            }
        }

        // Check if two variantions have the same attributes
        foreach($variantAttributes as $key1 => $attrVariant1) {
            foreach($variantAttributes as $key2 => $attrVariant2) {
                if( ($key1 !== $key2) && ($attrVariant1 == $attrVariant2)) {
                    $this->message = 'No puedes crear dos variantes con los mismos atributos';
                    return false;
                }
            }
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
