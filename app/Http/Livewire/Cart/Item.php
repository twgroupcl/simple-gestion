<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use App\Models\CartItem;
use App\Http\Chilexpress;
use App\Models\ShippingMethod;


class Item extends Component
{
    public $item;
    public $qty;
    public $total;
    public $view;
    //public $shipping;
    public $product;
    public $shippingMethods;
    public $confirm;
    public $communeSelected;
    public $individualShipment;
    public $show;

    protected $listeners = [
        'setQty',
        'updateItem' => 'updateCommune',
        'select-shipping-item' => 'addShippingItem',
    ];

    public function mount(CartItem $item, $view = 'cart.item')
    {

        $this->confirm = null;
        $this->item = $item;
        $this->product = $item->product;
        $this->view = $view;
        $this->qty = $this->item->qty;
        $this->total = $this->item->product->price * $this->qty;
        $this->shippingMethods =  $this->getShippingMethods();
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
        $this->total = $this->item->product->price * $qty;
        $this->item->qty = $qty;
        $this->emitUp('change', $this->item->id, $this->qty);
    }

    public function deleteConfirm($id)
    {
        $this->confirm = $id;
    }

    public function delete()
    {
        $this->emitUp('deleteItem', $this->item->id);
    }

    public function render()
    {
        return view('livewire.' . $this->view);
    }

    public function addShippingItem($selected)
    {
        $this->individualShipment = $selected;
        $this->emit('select-shipping', $selected, $this->item->id);
    }

    private function getShippingMethods()
    {
        $shippingsmethods = ShippingMethod::where('status', 1)->get();
        return $shippingsmethods;
    }

    public function updateShippingMethods()
    {
        $this->emit('loadingShipping');
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

        $this->shippingMethods = $tmpshippings;

        $this->emit('updateShipping', $this->shippingMethods);

    }

    public function updateCommune($communeid)
    {
        $this->communeSelected = $communeid;
    }
}
