
<div class="row">
    <div class="col-md-3">
        <p><strong>Nombre: </strong>
            {{$invoice->first_name}}
        </p>
    </div>
    <div class="col-md-3">
        <p><strong>Total: </strong>
            {{$invoice->total}}
        </p>
    </div>
    <div class="col-md-3">
        <p><strong>Código de documento: </strong>
            {{$invoice->dte_code}}
        </p>
    </div>

</div>
