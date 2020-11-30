<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;

class ProductCustomAttributes extends Component
{
    protected $listeners = [
        'productShared' => 'setProductDetailsInModal',
    ];

    public $product;
    public $parentProduct;
    public $currentProduct;
    public $attributes;
    public $options = [];
    public $selectedChildrenId;
    public $currentPrice;
    public $currentProductChange = false;

    public function render()
    {
        return view('livewire.pos.product-custom-attributes');
    }

    public function setProductDetailsInModal(Product $product, $currentPrice)
    {
        $this->product = $product;
        $this->parentProduct = $product;
        $this->currentProduct = $product;
        $this->currentPrice = $currentPrice;
        $this->options = [];
        $this->getInitialOptions();
        $this->dispatchBrowserEvent('showModal');
    }

    public function getInitialOptions()
    {
        foreach ($this->parentProduct->super_attributes as $key => $super_attribute) {

            $options = [];

            // options items
            foreach ($this->parentProduct->children as $child) {
                $attributeValue = $child->custom_attributes->where('product_class_attribute_id', $super_attribute->id)->first();
                array_push($options, $attributeValue->json_value);
            }

            // remove duplicate items
            $options = array_unique($options);

            // Add default empty option
            $options = array_merge(['Selecciona una opción'], $options);

            array_push($this->options, [
                'id' => $super_attribute->id,
                'name' => $super_attribute->name,
                'selectedValue' => '',
                'enableOptions' => ($key == 0) ? true : false,
                'items' => ($key == 0) ? $options : [],
            ]);
        }
    }

    public function updatedOptions($value, $index)
    {
        $tempCurrent = $this->currentProduct;

        $this->loadNextSelect(explode(".", $index)[0]);

        $this->setCorrectOption();

        // Find the correct child product depending on the options selected
        $selectedChildren = $this->parentProduct->children->filter(function ($children) {
            foreach ($children->custom_attributes as $attribute) {

                $options = collect($this->options);
                $optionSelected = $options->where('id', $attribute->product_class_attribute_id)->first();

                if (empty($optionSelected)) return false;

                if ($attribute->json_value != $optionSelected['selectedValue']) {
                    return false;
                }
            }
            return true;
        })->first();

        if (!empty($selectedChildren)) {
            $this->selectedChildrenId = $selectedChildren->id;
            $this->currentProduct = $selectedChildren;
            $this->emit('addToCart.setProduct', $this->currentProduct);
        } else {
            $this->selectedChildrenId = null;
            $this->currentProduct = $this->parentProduct;
        }

        if ($tempCurrent->id == $this->currentProduct->id) {
            $this->currentProductChange = false;
        } else {
            $this->currentProductChange = true;
        }
    }

    /**
     * Load the options of the next select according to the opciones selected before
     *
     *
     */
    public function loadNextSelect($index)
    {
        if ($index + 1 < count($this->options)) {
            // Enable the next select and clean the old selected value
            $this->options[$index + 1]['enableOptions'] = true;
            $this->options[$index + 1]['selectedValue'] = '';

            // Load next select options depending on the previous one
            $itemOptions = ['Selecciona una opción'];
            foreach ($this->parentProduct->children as $children) {
                $meetPreviusReq = true;

                // Check if the children product meet the previous requeriments
                for ($i = $index; $i >= 0; $i--) {
                    $result = $children->custom_attributes
                        ->where('product_class_attribute_id', $this->options[$i]['id'])
                        ->where('json_value', $this->options[$i]['selectedValue'])->first();

                    if (empty($result)) {
                        $meetPreviusReq = false;
                    }
                }

                // Get available options for the product
                if ($meetPreviusReq) {
                    foreach ($children->custom_attributes as $custom_attribute) {
                        if ($custom_attribute->product_class_attribute_id == $this->options[$index + 1]['id']) {
                            array_push($itemOptions, $custom_attribute->json_value);
                        }
                    }
                }
            }

            // Set available options for the select
            $this->options[$index + 1]['items'] = $itemOptions;
        }

        // Disabled and clear the other selects
        for ($i = $index + 2; $i < count($this->options); $i++) {
            $this->options[$i]['enableOptions'] = false;
            $this->options[$i]['selectedValue'] = '';
            $this->options[$i]['items'] = [];
        }
    }

    /**
     * This is necesary when there is only one option in the select because
     * livewire doesnt assing the by itself
     *
     */
    public function setCorrectOption()
    {
        foreach ($this->options as &$option) {
            if (count($option['items']) == 1) {
                $option['selectedValue'] = $option['items'][0];
            }
        }
    }

}
