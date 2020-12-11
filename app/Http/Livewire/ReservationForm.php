<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Service;
use Livewire\Component;
use App\Models\TimeBlock;

class ReservationForm extends Component
{
    public $company;
    public $rut;
    public $date;
    public $services;
    public $timeblocks = [];
    public $serviceSelected = null;
    public $timeblockPlaceholder;
    
    public $errors;
    public $sessionError;

    public function render()
    {
        return view('livewire.reservation-form');
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        $this->rut = old('rut') ?? '';
        $this->date = old('date') ?? '';
        $this->serviceSelected = old('service_id') ?? '';

        $this->loadServices();
        $this->updatedServiceSelected();
        
    }

    public function setTimeblockPlaceholder()
    {
        if (count($this->timeblocks)) {
            $this->timeblockPlaceholder = 'Selecciona una opción';
        } else {
            $this->timeblockPlaceholder = 'Este servicio no tiene ningun bloque disponible';
        }
    }

    public function loadServices()
    {
        $this->services = Service::where('status', '1')->where('company_id', $this->company->id)->orderBy('name')->get();
        $this->serviceSelected = $this->serviceSelected ?: ($this->services->first()->id ?? null);
    }

    public function updatedServiceSelected()
    {
        $this->timeblocks = TimeBlock::whereHas('services', function ($query) {
            return $query->where('id', $this->serviceSelected);
        })->get();

        $this->setTimeblockPlaceholder();
    }
}
