<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $inventories = [];

        if ($this->inventories) {
            foreach ($this->inventories as $inventory) {
                $inventories[] = [
                    'name' => $inventory->name,
                    'code' => $inventory->code,
                    'qty' => $inventory->pivot->qty,
                ];
            }
        }

        $shippings = [];

        if (!empty($this->shipping_methods)) {
            foreach ($this->shipping_methods as $shipping) {
                $shippings[] = [
                    'id' => $shipping->id,
                    'title' => $shipping->title,
                    'code' => $shipping->code,
                ];
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'sku' => $this->sku,
            'price' => $this->price,
            'special_price' => $this->special_price,
            'special_price_from' => $this->special_price_from,
            'special_price_to' => $this->special_price_to,
            'width' => $this->width,
            'depth' => $this->depth,
            'weight' => $this->weight,
            'height' => $this->height,
            'width' => $this->width,
            'inventories' => $inventories,
            'shippings' => $shippings,
        ];
    }
}
