<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Seller;
use App\Mail\SendMessageArrangeToSeller;

class SendMessageToSeller extends Component
{
    public $enable;
    public $seller;
    public $order;

    protected function rules()
    {
        return [
            'order.arrange_messages.*' => 'required:min:6:max:500',
        ];
    } 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->enable = true;
    }

    public function send()
    {
        $this->validate();
        $this->order->updateWithoutEvents();
        try {
            \Mail::send(new SendMessageArrangeToSeller($this->seller, $this->order));
        } catch(\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.send-message-to-seller');
    }
}
