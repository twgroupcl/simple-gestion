@extends(backpack_view('layouts.top_left'))
@section('header')
  <div class="container-fluid">
    <h3>
        Exportar Libros de compra y venta  (CSV)
    </h3>
  </div>
@endsection

@section('content')

    <form method="post" action="/admin/exports/csv-book">
        {{csrf_field()}}
        <label for="period">Periodo<small class="text-primary"> (Indicar año seguido del mes: 202105)</small></label>
        <input class="form-control mt-2 mb-2 col-md-3" placeholder="202105" name="period" id="period"/> 
        @if($errors->has('period'))
            <div class="error text-danger"><small>{{ $errors->first('period')}}</small></div>
        @endif
        <select class="form-control mt-2 mb-2 col-md-3" name="type">
            <option value="0"> Libro de Venta </option>
            <option value="1"> Libro de Compra </option>
        </select>
        @if($errors->has('type'))
            <div class="error text-danger"><small>{{ $errors->first('type')}}</small></div>
        @endif

        <button class="btn btn-primary text-secondary"> Descargar libro </button>
    </form>
@endsection
