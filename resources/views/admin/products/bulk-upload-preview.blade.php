@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Subir productos masivamente</h3>
        </div>
	</div>

    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline collapsed has-hidden-columns" aria-describedby="crudTable_info" role="grid" cellspacing="0">
      <thead>
        <tr role="row">
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 3
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
          <th>
            Campo 1
          </th>
          <th>
            Campo 2
          </th>
        </tr>
      </thead>

      <tbody>
        <tr role="row" class="odd">
          <td class="dtr-control">
            <span>
              Valor 1
            </span>
          </td>
          <td class="dtr-control">
            <span>
              Valor 2
            </span>
          </td>
		</tr>
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