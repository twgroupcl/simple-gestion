<div class="col-md-8">
    <form action="{{ route('reservation-request.store', [ 'company' => $company->id ]) }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4 align-self-center mb-2 mb-md-0">
                <div class="font-size-lg">RUT</div>
            </div>
            <div class="col">
                <input 
                type="text" 
                class="form-control" 
                name="rut"
                placeholder="Ingresa tu RUT"
                id="rut"
                wire:model.lazy="rut"
                required
            >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 align-self-center mb-2 mb-md-0">
                <div class="font-size-lg">Fecha de reserva</div>
            </div>
            <div class="col">
                <input wire:model="date" class="form-control" type="date" name="date" placeholder="Fecha de reserva" value="{{ old('date') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 align-self-center mb-2 mb-md-0">
                <div class="font-size-lg">Servicio</div>
            </div>
            <div class="col">
                <select 
                wire:model="serviceSelected"
                class="custom-select" 
                name="service_id" 
                placeholder="Bloque horario" 
                required
            >
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 align-self-center mb-2 mb-md-0">
                <div class="font-size-lg">Bloque horario</div>
            </div>
            <div class="col">
                <select 
                    class="custom-select" 
                    name="time_block_id" 
                    placeholder="Bloque horario" 
                    @if (!count($timeblocks)) disabled @endif
                    required
                >
                    <option disabled selected>{{ $timeblockPlaceholder}}</option>
                    @foreach ($timeblocks as $timeblock)
                    <option value="{{ $timeblock->id }}">{{ $timeblock->name_with_time }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h5>Declaración jurada de estado de salud.</h5>
                <ul class="text-justify">
                    <li>No he dado ni he estado en contacto con alguien que haya dado positivo al COVID-19.</li>
                    <li>No tengo pendiente los resultados de pruebas de COVID-19.</li>
                    <li>No he tenido fiebre, dificultad para respirar, congestión nasal dolor de garganta, dolor de cabeza, tos persistente ni ningún otro síntoma de COVID-19 en los últimos 14 días.</li>
                    <li>No he tenido contacto con alguien con fiebre, dificultad para respirar, congestión nasal dolor de garganta, dolor de cabeza, tos persistente ni ningún otro síntoma de COVID-19 en los últimos 14 días.</li>
                    <li>No he regresado de un viaje ni estado en contacto con alguien que haya regresado de un viaje en los últimos 14 días.</li>
                </ul>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="custom-control custom-checkbox">
                    <input wire:model="checkDeclaracionJurada"class="custom-control-input" type="checkbox" id="checkbox_declaracion_jurada">
                    <label class="custom-control-label" for="checkbox_declaracion_jurada">Declaro que la información entregada es correcta y fidedigna</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <button 
                    type="submit" 
                    class="btn btn-primary btn-lg btn-block"
                    @if ($checkDeclaracionJurada == false) disabled @endif
                >
                    Solicitar reserva
                </button>
            </div>
        </div>
    </form>
</div>
