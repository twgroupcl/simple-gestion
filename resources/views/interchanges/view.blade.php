@extends(backpack_view('layouts.top_left'))
@section('header')
  <div class="container-fluid">
    <h3>
        Intercambio - Código: {{$data->DteIntercambio->codigo}}
    </h3>
  </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <form >
        <div class="d-flex justify-content-end">
            <button class="btn btn-lg btn-primary">Recibir</button>
        </div>
        <div>
            <label> Recinto 
                <input class="form-control col-md-6" readonly="readonly" value="{{ $data->Receptor->direccion}}" />
            </label>
            <label> Enviar 
                <input class="form-control col-md-6" readonly="readonly" value="{{ $data->Receptor->direccion}}" />
            </label>
        </div>
        <hr/>
        <h4>Emisor</h4>
        <label> RUT 
            <input class="form-control col-md-6" readonly="readonly" value="{{ $data->Emisor->rut }}" />
        </label>
        <label> Razón social 
            <input class="form-control col-md-8" readonly="readonly" value="{{ $data->Emisor->razon_social }}" />
        </label>
        <label> 
            <input class="form-control col-md-8" readonly="readonly" value="{{ $data->Emisor->razon_social }}" />
        </label>
        <h4>Información del intercambio</h4>
        <label> Código
            <input class="form-control col-md-8" readonly="readonly" value="{{ $data->DteIntercambio->codigo}}" />
        </label>
        <label> Asunto
            <input class="form-control col-md-8" readonly="readonly" value="{{ $data->DteIntercambio->asunto}}" />
        </label>
        <hr/>
        <h4>
            Documentos
        </h4>
        @foreach($data->Documentos as $document)
            <label> Tipo
                <input class="form-control col-md-8" readonly="readonly" value="{{ $document->Encabezado->IdDoc->TipoDTE}}" />
            </label>
            <label> Folio
                <input class="form-control col-md-8" readonly="readonly" value="{{ $document->Encabezado->IdDoc->Folio}}" />
            </label>
            <label> Total
                <input class="form-control col-md-8" readonly="readonly" value="{{ $document->Encabezado->Totales->MntTotal}}" />
            </label>
            <label> Estado (seleccione)
                <select class="form-control" name="status-T{{$document->Encabezado->IdDoc->TipoDTE .'F'. $document->Encabezado->IdDoc->Folio}}">
                    <option value="ERM">Otorga recibo de mercaderías o servicios</option>
                    <option value="ACD">Acepta contenido del documento</option>
                    <option value="RCD">Reclamo al contenido del documento</option>
                    <option value="RFP">Reclamo por falta parcial de mercaderías</option>
                    <option value="RFT">Reclamo por falta total de mercaderías</option>
                </select>
            </label>

        @endforeach

        @php //print_r($data); @endphp
        </form>
    </div>
@endsection
