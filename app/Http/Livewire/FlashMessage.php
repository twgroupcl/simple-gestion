<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
    public $title;
    public $message;
    public $status;
    public $delay;
    public $type ;
    public $icon;
    public $session;

    public function mount()
    {
        $this->message = '';
        $this->title = '';
        $this->session = session()->get('message') ?? [];
        $this->delay= "3000";
        $this->type= 'success';
        $this->icon = 'czi-check-circle';
    }
 
    public function setType($string) : void
    {
        
        $this->type = $string !== null ? $string : 'success';
        $this->setIcon();
    }

    public function setIcon($icon = null) : void
    {
        if ($icon !== null) {
            $this->icon = $icon;
            return;
        }

        switch ($this->type) {
            case 'success':
                $this->icon = 'czi-check-circle';
                break;
            case 'info':
                $this->icon = 'czi-announcement';
                break;
            case 'warning':
                $this->icon = 'czi-security-announcement';
                break;
            case 'danger':
                $this->icon = 'czi-close-circle';
                break;
            default:
                $this->icon = 'czi-check-circle';
                break;
        }
    }

    public function show()
    {
        $this->status = 'show';
    }

    public function hide()
    {
        $this->status = '';
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.flash-message');
    }
}
