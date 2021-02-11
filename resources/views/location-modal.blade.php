@php
    $communes = App\Models\Commune::all()->sortBy('name');
@endphp

<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form action="{{ route('set-location') }}" method="post">
                @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 Elige tu ubicación
            </h5>
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
            </div>
            <div class="modal-body">
            <select name="commune_id" class="custom-select">
                @foreach ($communes as $commune)
                    <option 
                        value="{{ $commune->id }}"
                        @if (session()->get('commune_id') == $commune->id)
                        selected
                        @endif
                    >{{ $commune->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <input type="submit" class="btn btn-primary" value="Aceptar" />
            </div>
        </form>
        </div>
        
    </div>
</div>

@push('scripts')
@if (!request()->session()->has('commune_id'))
<script>
    $('#locationModal').modal({backdrop: 'static', keyboard: false})  
</script>  
@endif
@endpush