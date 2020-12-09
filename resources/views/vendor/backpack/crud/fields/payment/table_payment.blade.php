@include('crud::fields.inc.wrapper_start')
    <div class="card mb-6" style="padding: 10px;">
        <div class="col-md-12 order-md-2 mb-6">
            <p class="text-muted h5">Pagos registrados</p>
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Método de pago</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $arrData = json_decode($field['payment']->data_payment,true);
                    @endphp
                    @foreach($arrData['data_payment'] as $data)
                        <tr class="text-center">
                            <td>MP</td>
                            <td>${{ $data['amount_payment'] }}</td>
                            <td>Fecha</td>
                            <td>{{ $comment = ($data['comment'])?$data['comment']:'S/N' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('crud::fields.inc.wrapper_end')
