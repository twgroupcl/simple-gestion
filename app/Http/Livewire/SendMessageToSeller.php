<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Seller;

class SendMessageToSeller extends Component
{
    public $enable;
    public $seller;
    public $order;

    public function mount()
    {
        $this->enable = true;
    }

    public function send()
    {
        try {
            \Mail::send(new SendMessageArrangeToSeller($this->seller, $this->order));
        } catch(\Exception $e) {

        }
    }

    public function render()
    {
        return view('livewire.send-message-to-seller');
    }
}
