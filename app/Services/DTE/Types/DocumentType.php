<?php

namespace App\Services\DTE\Types;

interface DocumentType
{
    /**
     * Get document as array
     * ready for send api libredte
     */
    public function toArray();
}
