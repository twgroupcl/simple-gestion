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
                        $arrData = (!is_null($field['payment']->data_payment))?json_decode($field['payment']->data_payment,true):null;
                        $arr = (isset($arrData->payment_method))?json_decode($arrData['data_payment']):null;  
                    @endphp
                    
                    @if($arr != null)
                        @if($arr->amount_payment != null)
                            <tr class="text-center">
                                <td>
                                    @switch($arr->payment_method)
                                        @case('EF')
                                            Efectivo
                                        @break
                                        @case('CH')
                                            Cheque
                                        @break
                                        @case('CF')
                                            Cheque a Fecha
                                        @break
                                        @case('TC')
                                            Tarjeta de crédito
                                        @break
                                        @case('TD')
                                            Tarjeta de débito
                                        @break
                                        @case('TR')
                                            Tranferencia
                                        @break
                                        @case('PCC')
                                            Pago a cuenta corriente
                                        @break
                                        @case('OT')
                                            Otro
                                        @break
                                    @endswitch
                                </td>
                                <td>${{ $arr->amount_payment }}</td>
                                <td>{{ $arr->date_now }}</td>
                                <td>{{ $comment = ($arr->comment)?$arr->comment:'S/N' }}</td>
                            </tr>
                        @else    
                            @foreach($arrData as $data)
                                <tr class="text-center">
                                    <td>MP</td>
                                    <td>${{ $data['amount_payment'] }}</td>
                                    <td>{{ $data['date_now'] }}</td>
                                    <td>{{ $comment = ($data['comment'])?$data['comment']:'S/N' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @else
                        <tr class="text-center">
                            <td colspan="4"><p>No hay registros</p></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@include('crud::fields.inc.wrapper_end')
