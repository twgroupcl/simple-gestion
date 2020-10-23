<?php

// TODO remove
namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Http\Chilexpress;
use App\Models\ShippingMethod;

class Item extends Component
{
    public $item;
    public $shippingMethods;
    public $communeSelected;
    public $selected;
    public $shippingSelected;

    protected $listeners = [
        'select-shipping-item' => 'addShippingItem',
    ];
    public function mount()
    {

        // $this->confirm = null;
        // $this->item = $item;
        // $this->product = $item->product;
        // $this->view = $view;
        // $this->qty = $this->item->qty;
        // $this->total = $this->item->product->price * $this->qty;

        $this->communeSelected =  $this->item->cart->address_commune_id;
        $this->shippingMethods =  $this->getShippingMethods();
        // if(isset($this->shippingMethods[0])){
        //     $selected = $this->shippingMethods[0];
        //     $this->updateShipping($selected);
        // }
      //  dd($this->shippingMethods);
    }
    public function render()
    {
        return view('livewire.checkout.item');
    }

    public function getShippingMethods()
    {

        $tmpshippings = null;
        $shippingsmethods = ShippingMethod::where('status', 1)->get();

        foreach ($shippingsmethods as $shippingmethod) {
            $itemshipping = null;
            if ($shippingmethod->code == 'chilexpress') {
                $chilexpress = new Chilexpress();
                $result = $chilexpress->calculateItem($this->item, $this->communeSelected);

                $itemshipping['name'] = $shippingmethod->title;
                if ($result['is_available']) {

                    $resultitem = json_decode(json_encode($result['item']), false);

                    $itemshipping['price'] = $resultitem->service->serviceValue;
                    $itemshipping['message'] = $resultitem->service->serviceDescription;
                } else {
                    $itemshipping['price'] = null;
                    $itemshipping['message'] = $result['message'];
                }
                $itemshipping['is_available'] = $result['is_available'];
            } else {
                $json_value = json_decode($shippingmethod->json_value);
                $itemshipping['name'] = $shippingmethod->title;
                if ($json_value) {

                    if ($json_value[0]->variable_name == 'price') {
                        $itemshipping['price'] = $json_value[0]->variable_value;
                    }
                    if ($json_value[0]->variable_name == 'message') {
                        $itemshipping['message'] = $json_value[0]->variable_value;
                    } else {
                        $itemshipping['message'] = '';
                    }
                } else {
                    $itemshipping['message'] = '';
                    $itemshipping['price'] = 0;
                }
                $itemshipping['is_available'] = true;
            }
            $tmpshippings[] = $itemshipping;
        }

        return $tmpshippings;
    }

    public function updatedSelected($value)
    {
        $this->shippingSelected = $this->shippingMethods[$value];
    }
    public function addShippingItem(){
        if ($this->shippingSelected) {

            $this->emitUp('select-shipping',$this->shippingSelected , $this->item->id);
        }
    }
}
