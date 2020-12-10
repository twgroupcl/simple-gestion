<div class="col-md-8">
    <form action="{{ route('reservation-request.store', [ 'company' => $company->id ]) }}" method="POST">
        @csrf

        @if(count($errors))
        <div class="row">
            <div class="col">
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-4 align-self-center mb-sm-2">
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
                value="{{ old('rut') }}"
                required
            >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 align-self-center">
                <div class="font-size-lg">Fecha de reserva</div>
            </div>
            <div class="col">
                <input wire:model="date" class="form-control" type="date" name="date" placeholder="Fecha de reserva" value="{{ old('date') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 align-self-center">
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
            <div class="col-md-4 align-self-center">
                <div class="font-size-lg">Bloque horario</div>
            </div>
            <div class="col">
                <select class="custom-select" name="time_block_id" placeholder="Bloque horario" required>
                    @foreach ($timeblocks as $timeblock)
                        <option value="{{ $timeblock->id }}">{{ $timeblock->name_with_time }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Solicitar reservación
                </button>
            </div>
        </div>
    </form>
</div>
