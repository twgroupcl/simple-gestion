<?php

namespace App\Http\Livewire\Traits;

trait Cursor
{
    public $cursor = 'auto';

    public function setCursor($string)
    {
        $this->cursor = $string;
    }

    public function updatedWithCursor($name, $value)
    {
        $this->cursor = 'auto';
    }
}