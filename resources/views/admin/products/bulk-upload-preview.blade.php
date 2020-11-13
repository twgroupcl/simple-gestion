@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Subir productos masivamente</h3>
        </div>
	  </div>

    <div class="card">
      <div class="card-body row">
          <div class="col-md-12">
            Numero de productos cargados: {{ count($result['products_array']) }}
          </div>
          <div class="col-md-12">
            Productos con errores: {{ $result['products_with_errors'] }}
          </div>
      </div>
  </div>


    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline collapsed has-hidden-columns" aria-describedby="crudTable_info" role="grid" cellspacing="0">
      <thead>
        <tr role="row">
          @foreach ($result['table_visible_rows'] as $keyName => $visibleName)
            <th>
              {{ $visibleName }}
            </th>
          @endforeach
        </tr>
      </thead>

      <tbody>
        @foreach ($result['products_array'] as $product)
          <tr role="row" class="odd" @if (count($product['errors'])) style="background: #ffc3c3" @endif >
          @foreach ($result['table_visible_rows'] as $keyName => $visibleName)
            <td class="dtr-control">
              @if ($keyName == 'errors')
                  aqui los errores
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
    
    <div class="btn-group" role="group">
        <button type="submit" class="btn btn-success">
            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
            <span data-value="save_and_back">Cargar productos</span>
        </button>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-default"><span class="la la-ban"></span> &nbsp;Cancelar</a>
@endsection