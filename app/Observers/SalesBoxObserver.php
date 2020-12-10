<?php

namespace App\Observers;

use App\Models\SalesBox;

class SalesBoxObserver
{
    public function created(SalesBox $salesBox)
    {
        $salesBox->logs()->create([
            'event' => 'Caja abierta',
        ]);
    }

    public function updated(SalesBox $salesBox)
    {
        $salesBox->logs()->create([
            'event' => 'Caja cerrada',
        ]);
    }
}
