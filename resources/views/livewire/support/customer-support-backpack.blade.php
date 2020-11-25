@php
    $notes = $crud->entry->notes()->latest()->get();
@endphp

@foreach ($notes as $note)
<div class="col-sm-12">
    <div class="form-group">
        <label for="commune_id">Fecha: {{ $note->created_at->format('d/m/Y') }}</label>
        <div class="col-md-12">
            <textarea class="col-md-12" disabled>{{ $note->note }}</textarea>
        </div>
    </div>
</div>
@endforeach
