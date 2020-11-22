@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Subir libros masivamente</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body row">
            <div class="col-auto">
              <div class="col px-0">
                @if ($result['products_with_errors'] !== 0)
                <i class="la la-info-circle" style="font-size: 48px; color:#c41515;"></i>
                @else
                <i class="la la-check-circle" style="font-size: 48px; color:#15c441;"></i>
                @endif
              </div>
            </div>
            <div class="col-md-10 px-0">
              <div class="col-md-12">
                Numero de libros cargados: {{ count($result['products_array']) }}
              </div>
              <div class="col-md-12">
                  Numero de libros con errores: {{ $result['products_with_errors'] }}
              </div>
            </div>
        </div>
    </div>

    @if (!$result['validate_images'])
        <div class="card" style="overflow-y: auto; overflow-x: hidden; max-height: 400px;">
          <div class="card-body row">
            <div class="col-auto">
              <div class="col px-0">
                <i class="la la-info-circle" style="font-size: 48px; color:#c41515;"></i>
              </div>
            </div>
            <div class="col-md-10 px-0" style="align-self: center">
              <div class="col-md-12">
                Se encontraron los siguientes errores en el comprimido ZIP de las imagenes:
              </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12" style="padding-left: 75px;">
                    <ul>
                        @foreach ($result['image_errors'] as $imageError)
                            <li>{{ $imageError }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    <div class="row mt-3">
        <div class="col">
            <h3>Vista previa de libros obtenidos del EXCEL</h3>
        </div>
    </div>

    @if ($result['validate'] && $result['validate_images'])

        <div class="btn-group" role="group">
            <form method="POST" action="{{ route('products.bulk-upload-store') }}">
                @csrf
                <input type="hidden" name="seller_id" value="{{ request('seller_id') }}">
                <button type="submit" class="btn btn-success">
                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                    <span data-value="save_and_back">Cargar libros</span>
                </button>
            </form>
        </div>

    @endif

    <a href="{{ route('products.bulk-upload') }}" class="btn btn-default"><span class="la la-angle-left"></span>
        &nbsp;Volver y cargar otro archivo</a>

    <table id="crudTable"
        class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline collapsed has-hidden-columns"
        aria-describedby="crudTable_info" role="grid" cellspacing="0">
        <thead>
            <tr role="row">
                @foreach ($result['table_visible_rows'] as $keyName => $visibleName)
                    <th @if ($keyName === 'errors') style="min-width: 350px" @endif>
                        {{ $visibleName }}
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($result['products_array'] as $product)
                <tr role="row" class="odd" @if (count($product['errors']))
                    style="background: #ffc3c3"
            @endif >
            @foreach ($result['table_visible_rows'] as $keyName => $visibleName)
                <td class="dtr-control">
                    @if ($keyName == 'errors')
                        <ul>
                            @foreach ($product['errors'] as $fieldErrors)
                                @foreach ($fieldErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endforeach
                            <ul>
                            @else
                                <span>
                                    {{ $product[$keyName] }}
                                </span>
                    @endif
                </td>
            @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($result['validate'] && $result['validate_images'])

        <div class="btn-group" role="group">
            <form method="POST" action="{{ route('products.bulk-upload-store') }}">
                @csrf
                <input type="hidden" name="seller_id" value="{{ request('seller_id') }}">
                <button type="submit" class="btn btn-success">
                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                    <span data-value="save_and_back">Cargar libros</span>
                </button>
            </form>
        </div>

    @endif

    <a href="{{ route('products.bulk-upload') }}" class="btn btn-default"><span class="la la-angle-left"></span>
        &nbsp;Volver y cargar otro archivo</a>
@endsection
