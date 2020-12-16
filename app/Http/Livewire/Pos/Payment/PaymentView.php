<?php

namespace App\Http\Livewire\Pos\Payment;

use App\Models\Order;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderItem;

class PaymentView extends Component
{
    public $customer;
    public $cash;
    public $change;
    public $total;
    protected $listeners=[
        'payment.updated'=>'update'
    ];
    public function mount()
    {

        $this->cash = 0;
        $this->change = null;
        if (session()->get('user.pos.selectedCustomer')) {
            $this->customer = Customer::find(session()->get('user.pos.selectedCustomer')->id);
        }
        if (session()->get('user.pos.cart')) {
            $this->total = json_decode(session()->get('user.pos.cart'))->total;
        }

    }
    public function render()
    {
        return view('livewire.pos.payment.payment-view');
    }

    public function chr($value)
    {
        if ($value == '<<') {
            if (strlen($this->cash) > 1) {
                $this->cash = substr_replace($this->cash, "", -1);
            }
        } else {
            if ($value == 'clear') {
                $this->cash = '0';
            } else {
                $this->cash .= $value;
            }
        }
        $this->calculeChange();
    }

    private function calculeChange()
    {

        $tmpCash = floatval($this->cash);
        $tmpChange = $tmpCash - $this->total;
        if ($tmpChange > 0) {
            $this->change = $tmpChange;
        } else {
            $this->change = 0;
        }
    }

    // TODO add confirm modal with messages
    public function confirmPayment()
    {
       $this->emit('cart.confirmPayment',$this->cash);

    }

    public function updated()
    {
        if (session()->get('user.pos.cart')) {
            $this->total = json_decode(session()->get('user.pos.cart'))->total;
        }
    }
}
