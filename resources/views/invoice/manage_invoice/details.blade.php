<div class="row">
    <h3>Detalles de la factura:</h3>
</div>
<div class="container-fluid animated fadeIn card">
    <div class="card-body">
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
                <p><strong>Fecha: </strong>
                {{$invoice->invoice_date}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Código de documento: </strong>
                    {{$invoice->dte_code ?? "S/código"}}
                </p>
            </div>
        </div>
    </div>
</div>
