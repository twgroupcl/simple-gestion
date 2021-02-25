@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Cargar recepción desde Excel</h3>
        </div>
    </div>

    {{-- Informacion general del documento --}}
    <div class="card">
        <div class="card-body row">
            <div class="col-auto">
              <div class="col px-0">
                <i class="la la-archive" style="font-size: 48px;  
                    @if(!$arrayData['options']['typeOperation']['valid']) color:#c41515;" @else color: #15c441;" @endif
                ></i>
              </div>
            </div>
            <div class="col-md-10 px-0">
              <div class="col-md-12">
                Tipo de operación: {{ $arrayData['options']['typeOperation']['value'] }}
              </div>
              @if ($arrayData['options']['documentNumber']['value'])
                <div class="col-md-12">
                    Número de documento: {{ $arrayData['options']['documentNumber']['value'] }}
                </div> 
              @endif
              

              @if (!$arrayData['options']['typeOperation']['valid'])
                <div class="col-md-12">
                    <strong>Error en encabezado</strong>: Los valores permitidos para tipo de operación son: [sumar] y [reemplazar]
                </div>
              @endif
            </div>
        </div>
    </div>

    {{-- Numero de productos y errores --}}
    <div class="card">
        <div class="card-body row">
            <div class="col-auto">
              <div class="col px-0">
                @if ($arrayData['products_with_errors'] !== 0)
                <i class="la la-info-circle" style="font-size: 48px; color:#c41515;"></i>
                @else
                <i class="la la-check-circle" style="font-size: 48px; color:#15c441;"></i>
                @endif
              </div>
            </div>
            <div class="col-md-10 px-0">
              <div class="col-md-12">
                Numero de productos: {{ count($arrayData['products_array']) }}
              </div>
              <div class="col-md-12">
                  Numero de productos con errores: {{ $arrayData['products_with_errors'] }}
              </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-2">
        <div class="col">
            <h3>Vista previa</h3>
        </div>
    </div>

    {{-- Boton confirmar operacion --}}
    @if ($arrayData['validate'])
        <div class="btn-group" role="group">
            <form method="POST" action="{{ route('inventory.mass-receptions.store') }}">
                @csrf
                <button type="submit" class="btn btn-success">
                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                    <span data-value="save_and_back">Realizar actualización de Stock</span>
                </button>
            </form>
        </div>
    @endif

    {{-- Boton volver atras --}}
    <a href="{{ route('inventory.mass-receptions') }}" class="btn btn-default"><span class="la la-angle-left"></span>
        &nbsp;Volver y cargar otro archivo
    </a>

    @php
        $previewProducts = collect($arrayData['products_array']);
        $previewProducts = $previewProducts->sort(function ($a, $b) {
            return count($a['errors']) < count($b['errors']);
        });
    @endphp

    <table id="crudTable"
        class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline collapsed has-hidden-columns"
        aria-describedby="crudTable_info" role="grid" cellspacing="0">

        {{-- Encabezados --}}
        <thead>
            <tr role="row">
                <th>SKU</th>
                <th>Nombre</th>
                @foreach ($previewProducts[0]['inventories'] as $inventory)
                    <th>{{ $inventory['name'] }}</th>
                @endforeach
                <th>Errores</th>
            </tr>
        </thead>

        {{-- Cuerpo de la tabla --}}
        <tbody>
            @foreach ($previewProducts as $product)
                <tr role="row" class="odd" @if (count($product['errors']))
                    style="background: #ffc3c3" @endif 
                >
                    <td class="dtr-control">{{ $product['sku'] }}</td>
                    <td class="dtr-control">{{ $product['name'] }}</td>
                    @foreach ($product['inventories'] as $inventory)
                        <th>{{ $inventory['value'] }}</th>
                    @endforeach
                    <td class="dtr-control">
                        <ul>
                            @foreach ($product['errors'] as $fieldErrors)
                                @foreach ($fieldErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endforeach
                        <ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Boton confirmar operacion --}}
    @if ($arrayData['validate'])
        <div class="btn-group" role="group">
            <form method="POST" action="{{ route('inventory.mass-receptions.store') }}">
                @csrf
                <input type="hidden" name="seller_id" value="{{ request('seller_id') }}">
                <button type="submit" class="btn btn-success">
                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                    <span data-value="save_and_back">Realizar actualización de Stock</span>
                </button>
            </form>
        </div>
    @endif

    {{-- Boton volver atras --}}
    <a href="{{ route('inventory.mass-receptions') }}" class="btn btn-default"><span class="la la-angle-left"></span>
        &nbsp;Volver y cargar otro archivo
    </a>
@endsection
