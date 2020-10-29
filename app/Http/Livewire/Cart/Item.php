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
    public $selected;
    public $shippingSelected;
    // config view
    // show select shipping
    public $showShipping;
    // show attributes for configurable products
    public $showAttributes;

    protected $listeners = [
        'setQty',
        'cart-item.updateQty' => 'updateQty',
        'updateItem' => 'updateCommune',
        'select-shipping-item' => 'addShippingItem',
    ];

    protected $rules = [
        'qty' => 'required|numeric|gte:1|lte:16000000',
    ];

    protected $messages = [
        'gte' => 'La cantidad mayor o igual a 1.',
        'lte' => 'La cantidad supera el límite',
    ];

    public function mount(CartItem $item, $view = 'cart.item')
    {
        $this->confirm = null;
        $this->item = $item;
        $this->product = $item->product;
        $this->view = $view;
        $this->qty = $this->item->qty;
        $this->total = $this->item->product->price * $this->qty;
        $this->communeSelected =  $this->item->cart->address_commune_id;

        if ($this->showShipping) {
            if ($this->communeSelected) {
                $this->shippingMethods =  $this->getShippingMethods();
                // if ($this->shippingMethods) {
                //     $this->selected =0 ;
                //     $this->shippingSelected = $this->shippingMethods[0];

                //     $this->addShippingItem();
                //     //$this->emit('select-shipping-item');

                // }
            }
        }
    }

    public function setQty($qty)
    {
        $this->qty = $qty;

        $this->validateOnly('qty');

        if (!$this->item->product->haveSufficientQuantity($qty)) {
            $this->emit('showToast', '¡Stock insuficiente!', 'No se ha podido añadir al carro.', 3000, 'warning');
            return;
        }
        $this->item->qty = $qty;
        $this->item->sub_total = $this->item->product->price * $qty;
        $this->total = $this->item->product->price * $qty;
        $this->item->update();
        $this->emit('showToast', 'Cambió la cantidad', 'Has agregado más cantidad de un item al carro.', 3000, 'info');
        $this->emitUp('change');
    }

    public function updateQty()
    {
        $this->validateOnly('qty');

        $this->qty = $this->item->qty;
    }

    public function deleteConfirm($id)
    {
        $this->confirm = $id;
    }

    public function delete()
    {
        if (! CartItem::exists($this->item->id)) {
            return;
        }
        $this->emit('showToast', 'Se ha eliminado del carro.', 'Se ha eliminado el producto del carro.', 3000, 'info');
        $this->item->delete();
        $this->emitUp('deleteItem');
    }

    public function render()
    {
        return view('livewire.' . $this->view);
    }



    // public function addShippingItem($selected)
    // {
    //     $this->individualShipment = $selected;
    //     $this->emit('select-shipping', $selected, $this->item->id);
    // }

    public function getShippingMethods()
    {

        $seller  = $this->item->product->seller;
        //dd($seller->shippingmethods()->get());
        $tmpshippings = null;
        $shippingsmethods = $seller->shippingmethods()->where('status', 1)->get() ;// ShippingMethod::where('status', 1)->get();

        foreach ($shippingsmethods as $shippingmethodseller) {
            $shippingmethod = $shippingmethodseller->shipping_method;
            $itemshipping = null;
            if ($shippingmethod->code == 'chilexpress') {
                $chilexpress = new Chilexpress();
                $result = $chilexpress->calculateItem($this->item, $this->communeSelected);
                $itemshipping['id'] = $shippingmethod->id;
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
                $itemshipping['id'] = $shippingmethod->id;
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

    // public function updateShippingMethods()
    // {
    //     $this->emit('loadingShipping');
    //     $tmpshippings = null;
    //     $shippingsmethods = ShippingMethod::where('status', 1)->get();

    //     foreach ($shippingsmethods as $shippingmethod) {
    //         $itemshipping = null;
    //         if ($shippingmethod->code == 'chilexpress') {
    //             $chilexpress = new Chilexpress();
    //             $result = $chilexpress->calculateItem($this->item, $this->communeSelected);

    //             $itemshipping['name'] = $shippingmethod->title;
    //             if ($result['is_available']) {

    //                 $resultitem = json_decode(json_encode($result['item']), false);

    //                 $itemshipping['price'] = $resultitem->service->serviceValue;
    //                 $itemshipping['message'] = $resultitem->service->serviceDescription;
    //             } else {
    //                 $itemshipping['price'] = null;
    //                 $itemshipping['message'] = $result['message'];
    //             }
    //             $itemshipping['is_available'] = $result['is_available'];
    //         } else {
    //             $json_value = json_decode($shippingmethod->json_value);
    //             $itemshipping['name'] = $shippingmethod->title;
    //             if ($json_value) {

    //                 if ($json_value[0]->variable_name == 'price') {
    //                     $itemshipping['price'] = $json_value[0]->variable_value;
    //                 }
    //                 if ($json_value[0]->variable_name == 'message') {
    //                     $itemshipping['message'] = $json_value[0]->variable_value;
    //                 } else {
    //                     $itemshipping['message'] = '';
    //                 }
    //             } else {
    //                 $itemshipping['message'] = '';
    //                 $itemshipping['price'] = 0;
    //             }
    //             $itemshipping['is_available'] = true;
    //         }
    //         $tmpshippings[] = $itemshipping;
    //     }

    //     $this->shippingMethods = $tmpshippings;

    //     $this->emit('updateShipping', $this->shippingMethods);

    // }

    public function updateCommune($communeid)
    {
        $this->communeSelected = $communeid;
    }

    public function updatedSelected($value)
    {
        if ($value>0) {
            $this->shippingSelected = $this->shippingMethods[$value];
        }
    }
    public function addShippingItem()
    {


        if ($this->shippingSelected) {
            $this->emitUp('select-shipping', $this->shippingSelected, $this->item->id);
        }
    }
    public function setSelected($value)
    {
        if ($this->shippingMethods) {
            $this->selected =$value ;
            $this->shippingSelected = $this->shippingMethods[$value];
            $this->addShippingItem();
            //$this->emit('select-shipping-item');

        }
    }


}
