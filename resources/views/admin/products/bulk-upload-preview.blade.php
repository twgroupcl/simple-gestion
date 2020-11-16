@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Vista previa de productos a cargar</h3>
        </div>
	  </div>

    <div class="card">
      <div class="card-body row">
          <div class="col-md-12">
            Numero de productos cargados: {{ count($result['products_array']) }}
          </div>
          <div class="col-md-12">
            Numero de productos con errores: {{ $result['products_with_errors'] }}
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

    @if ($result['validate'])
    
      <div class="btn-group" role="group">
        <form method="POST" action="{{ route('products.bulk-upload-store') }}">
        @csrf
        <input type="hidden" name="seller_id" value="{{ request('seller_id') }}">
        <button type="submit" class="btn btn-success">
            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
            <span data-value="save_and_back">Cargar productos</span>
        </button>
      </form> 
      </div> 
   
    @endif
    
    <a href="{{ route('products.bulk-upload') }}" class="btn btn-default"><span class="la la-angle-left"></span> &nbsp;Volver y cargar otro archivo</a>
@endsection