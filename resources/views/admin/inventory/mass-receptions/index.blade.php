@php $today = date('Y-m-d'); @endphp

@extends(backpack_view('blank'))

@section('content')
    
    <div class="row mt-3">
        <div class="col">
            <h3>Cargar recepción desde Excel</h3>
        </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger pb-0">
        <ul class="list-unstyled">
                <li><i class="la la-info-circle"></i> {{ session('error') }}</li>
        </ul>
    </div>    
    @endif
        <div class="card">
            <div class="card-body row">
                <form action="{{ route('inventory.mass-receptions.generate-template') }}">
                    <div class="col-md-12">
                        <h4>Paso 1: Generar plantilla excel</h4>
                        <p>Haz clic en el botón para generar una plantilla de carga de recepciones / actualizaciones de stock masivas </p>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="replaceStock">Reemplazar stock o sumar cantidad</label>
                                    <select class="form-control" id="replaceStock" name="replaceStock">
                                      <option value="1">Reemplazar Stock</option>
                                      <option value="0">Sumar cantidad</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documentNumber">Numero de documento (opcional)</label>
                                    <input type="text" class="form-control" id="documentNumber" name="documentNumber">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="includeProducts" name="includeProducts">
                                    <label class="form-check-label" for="includeProducts">
                                      Incluir datos de productos
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <button class="btn btn-info" type="submit">Generar plantilla</button>
                    </div>
                </form>

                <div class="col-md-12 mb-2">
                    <h4>Paso 2: Subir archivo excel</h4>
                </div>

                <form action="{{ route('inventory.mass-receptions.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12 required">
                        <label><strong>Archivo EXCEL</strong></label>
                        <input required type="file" name="inventory_excel" value="" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit">Subir archivo y ver vista previa</button>
                    </div>
                </form>

                {{-- <div class="col">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                </div> --}}
            </div>
        </div>

        {{-- <div class="btn-group" role="group">
            <button type="submit" class="btn btn-success">
                <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                <span>Vista previa de libros a cargar</span>
            </button>
        </div> --}}
@endsection

@push('after_styles')
<link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('after_scripts')
<script src="{{ asset('js/jquery.form.js') }}"></script> 
<script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#seller_select2').select2();
    });

    $(function() {

        var bar = $('.progress-bar');
        var percent = $('.percent');
        var status = $('#status');

        $('#form-bulk').ajaxForm({
            target: 'body',
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                percent.show();
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
            }
        });
    }); 
</script>
@endpush