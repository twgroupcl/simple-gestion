<?php

namespace App\Services\DTE;

interface DocumentType
{
    /**
     * Get document as array
     * ready for send api libredte
     */
    public function toArray();
}
