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
    
    public $errors;
    public $sessionError;

    public function render()
    {
        return view('livewire.reservation-form');
    }

    public function mount(Company $company, $errors, $sessionError)
    {
        $this->company = $company;
        $this->errors = $errors ?: [];
        $this->sessionError = $sessionError ?: null;

        $this->rut = old('rut') ?? '';
        $this->date = old('date') ?? '';
        $this->serviceSelected = old('service_id') ?? '';

        $this->loadServices();
        $this->updatedServiceSelected();
        
    }

    public function loadServices()
    {
        $this->services = Service::where('status', '1')->where('company_id', $this->company->id)->get();
    }

    public function updatedServiceSelected()
    {
        $this->timeblocks = TimeBlock::whereHas('services', function ($query) {
            return $query->where('id', $this->serviceSelected);
        })->get();
    }
}
