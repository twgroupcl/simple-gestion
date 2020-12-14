@include('crud::fields.inc.wrapper_start')
    <div class="card mb-6" style="padding: 10px;">
        <div class="col-md-12 order-md-2 mb-6">
            <p class="text-muted h5">Factura electrónica #{{$field['invoice']->id }}</p>
            <p class="text-muted h6">Emitída en fecha {{$field['invoice']->invoice_date }}</p>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Cliente</h6>
                    </div>
                    <div>
                        <span class="text-muted">{{$field['invoice']->customer->first_name }} {{$field['invoice']->customer->last_name }}</span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Total Documento</h6>
                    </div>
                    <div>
                        <span class="text-muted">$ {{$field['invoice']->total }}</span>
                    </div>
                </li> 
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Abonado</h6>
                    </div>
                    <div>
                        <span class="text-muted">$ @php echo $amoundPaid = (!is_null($field['payment']->amount_paid))?$field['payment']->amount_paid:0; @endphp</span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Restante</h6>
                    </div>
                    <div>
                        <span class="text-muted">                            
                            $
                            @php
                                echo $field['invoice']->total-$field['payment']->amount_paid;
                            @endphp
                        </span>
                    </div>
                </li> 
            </ul>
        </div>
    </div>
</div>