@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Recepciones masivas</h3>
        </div>
    </div>

    @if (session()->has('mass_reception_error'))
        <div class="alert alert-success pb-0">
            <ul class="list-unstyled">
                    <li><i class="la la-info-circle"></i> {{ session()->get('mass_reception_error') }}</li>
            </ul>
        </div>    
    @endif

    @if (session()->has('mass_reception_success'))
        <div class="alert alert-success pb-0">
            <ul class="list-unstyled">
                    <li><i class="la la-info-circle"></i> {{ session()->get('mass_reception_success') }}</li>
            </ul>
        </div>    
    @endif

    <div class="btn-group" role="group">
        <a href="{{ backpack_url('product') }}">
        <button type="submit" class="btn btn-success">
            <span class="la la-box" role="presentation" aria-hidden="true"></span> &nbsp;
            <span>Ir a products</span>
        </button>
        </a>
    </div>

    <a href="{{ route('inventory.mass-receptions') }}" class="btn btn-default"><span class="la la-angle-left"></span> &nbsp;Volver y cargar otro archivo</a>
@endsection