@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Subir libros masivamente</h3>
        </div>
    </div>

    @if ( !empty($error))
        <div class="alert alert-success pb-0">
            <ul class="list-unstyled">
                    <li><i class="la la-info-circle"></i> {{ $error }}</li>
            </ul>
        </div>    
    @endif

    @if ( !empty($success))
        <div class="alert alert-success pb-0">
            <ul class="list-unstyled">
                    <li><i class="la la-info-circle"></i> {{ $success }}</li>
            </ul>
        </div>    
    @endif

    <div class="btn-group" role="group">
        <a href="{{ backpack_url('product') }}">
        <button type="submit" class="btn btn-success">
            <span class="la la-box" role="presentation" aria-hidden="true"></span> &nbsp;
            <span>Ir a la pagina de libros</span>
        </button>
        </a>
    </div>

    <a href="{{ route('products.bulk-upload') }}" class="btn btn-default"><span class="la la-angle-left"></span> &nbsp;Volver y cargar otro archivo</a>

@endsection