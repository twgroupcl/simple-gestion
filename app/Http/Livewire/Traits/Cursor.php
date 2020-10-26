<?php

namespace App\Http\Livewire\Traits;

trait Cursor
{
    public $cursor = 'auto';

    public function setCursor(string $string)
    {
        $this->cursor = $string;
    }
}