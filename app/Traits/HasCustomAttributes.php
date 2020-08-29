<?php

namespace App\Http\Traits;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\AttributeModule;

trait HasCustomAttributes
{
    private $extraFields = [];
    private $modelName = null;

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }

    public function getExtras()
    {
        $parent = (new \ReflectionClass(static::class))->getShortName();
        $this->modelName = strtolower(str_replace('CrudController', '', $parent));

        $module = AttributeModule::where('code', $this->modelName)->first();

        if (isset($module)) {
            $families = $module->families()->where('status', 1)->get();

            $attributesCollection = collect();

            foreach ($families as $family) {
                $attributes = $family->custom_attributes()->get();

                $attributesCollection->push($attributes);
            }

            $attributesCollection = $attributesCollection->collapse();

            $attributesCollection->each(function ($attribute) {

                $entry = $this->crud->getCurrentEntry();
                if (!empty($entry) && $entry) {
                    $value = $this->crud->getCurrentEntry()->attribute_values()->where('attribute_id', $attribute->id)->first();
                }

                $field = [
                    'name' => $attribute->code,
                    'label' => $attribute->admin_name,
                    'type' => $attribute->field->code,
                    'value' => !empty($value) ? $value->json_value : null,
                ];

                if ($attribute->group_is_tab) {
                    $field['tab'] = $attribute->group_name;
                }

                if (!empty($attribute->options)) {
                    $cleanJson = str_replace("\r\n", '', $attribute->options);
                    $field = array_merge($field, json_decode($cleanJson, true));
                }

                array_push($this->extraFields, $field);

                if (!empty($attribute->script)) {
                    array_push($this->extraFields, [
                        'name' => 'script_' . md5($attribute->script),
                        'type' => 'script',
                        'library' => $attribute->library,
                        'code' => $attribute->script,
                        'tab' => $attribute->group_name,
                    ]);
                }
            });
        }

        return $this->extraFields;
    }

    public function saveExtras($extras)
    {
        foreach ($extras as $key => $value) {
            $attribute = Attribute::where('code', $key)->first();

            $attributeValue = AttributeValue::where([
                ['model_type', '=', get_class($this->crud->model)],
                ['model_id', '=', $this->crud->entry->id],
                ['attribute_id', '=', $attribute->id],
            ])->first();

            if(!empty($attributeValue) && $attributeValue) {
                $attributeValue->update([
                    'json_value' => $value
                ]);
            } else {
                $attributeValue = new AttributeValue();

                $attributeValue->model_type = get_class($this->crud->model);
                $attributeValue->model_id = $this->crud->entry->id;
                $attributeValue->attribute_id = $attribute->id;
                $attributeValue->json_value = $value;

                $attributeValue->save();
            }

            // $this->crud->model->attribute_values()->updateOrCreate(
            //     [
            //         'attribute_id' => $attribute->id,
            //     ],
            //     [
            //         'attribute_id' => $attribute->id,
            //         'json_value' => $value,
            //     ]
            // );
        }
    }

    public function store()
    {
        $request = $this->crud->getRequest();

        $this->crud->setOperationSetting('saveAllInputsExcept', ['my_input_name', '_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $this->crud->setRequest($request);

        $meta = [];

        foreach ($this->extraFields as $field) {
            $key = $field['name'];

            $value = $request->get($key);

            $meta[$key] = $value;

            unset($request[$key]);

            $this->crud->removeField($key);
        }

        $response = $this->traitStore();

        $this->saveExtras($meta);

        return $response;
    }

    public function update()
    {
        $request = $this->crud->getRequest();

        $this->crud->setOperationSetting('saveAllInputsExcept', ['my_input_name', '_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $this->crud->setRequest($request);

        $meta = [];

        foreach ($this->extraFields as $field) {
            $key = $field['name'];

            $value = $request->get($key);

            $meta[$key] = $value;

            unset($request[$key]);

            $this->crud->removeField($key);
        }

        $response = $this->traitUpdate();

        $this->saveExtras($meta);

        return $response;
    }
}
