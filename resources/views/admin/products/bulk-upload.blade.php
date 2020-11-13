@extends(backpack_view('blank'))

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h3>Subir productos masivamente</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('products.bulk-upload-preview') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body row">
                <div class="form-group col-md-12 required">
                    <label>Archivo excel</label>
                    <input type="file" name="product-csv" value="" class="form-control">
                </div>
            </div>
        </div>

        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-success">
                <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                <span>Cargar productos</span>
            </button>
        </div>
    </form>
@endsection