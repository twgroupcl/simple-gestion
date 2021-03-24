<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductClassAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->json_attributes['name'],
            'code' => $this->json_attributes['code'],
            'type_attribute' => $this->json_attributes['type_attribute'],
            'options' => $this->json_options,
        ];
    }
}
