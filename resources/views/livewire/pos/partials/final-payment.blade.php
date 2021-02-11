@handheld
<div class="col-12 vh-100 final-payment-view " style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-close float-right close-final-payment" ></i></div>
    </div>

    <div class="row h-25">
        <div class="col-12">
            <h3>Operación finalizada</h3>
        </div>
    </div>
    <div class="row h-25">
        <div class="col-12"><h5 class="text-info text-center"> <i class="las la-envelope" style="font-size: 32px;"></i>Enviar la boleta por correo </h5></div>
        <div class="col-6">
            <button class="btn btn-secondary btn-block close-final-payment">NO</button>
        </div>
        <div class="col-6">
            @if(!is_null($existsOrder))
            <button wire:click="sendMail({{ optional($existsOrder)->invoice->id }})" class="btn btn-primary btn-block" >SI</button>
            @endif
        </div>
    </div>
    <div class="row  h-25">
        <div class="col-12"><h5 class="text-info text-center"><i class="las la-print" style="font-size: 32px;"></i>Enviar boleta al SII e Imprimir boleta </h5></div>
        <div class="col-6">
            <button class="btn btn-secondary btn-block close-final-payment">NO</button>
        </div>
        <div class="col-6">
            @if(!is_null($existsOrder))
            <a target="_blanck" href="{{ route('order.invoice', ['order' => $existsOrder->id , 'tipoPapel'=> 75]) }}" class="btn btn-primary btn-block ">Si</a>
            @endif
        </div>
    </div>
</div>
@elsehandheld
<div class="col-11  h-100 final-payment-view" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-close float-right close-final-payment" ></i></div>
    </div>
    <div class="row h-50">
        <div class="col-12">
            <h3>Venta finalizada</h3>
        </div>
    </div>
   {{--  <div class="row">
        <div class="col-12"><h5 class="text-info text-center"> <i class="las la-envelope" style="font-size: 32px;"></i>Enviar la factura por correo </h5></div>
        <div class="col-6">
            <button class="btn btn-secondary btn-block close-final-payment">NO</button>
        </div>
        <div class="col-6">
            @if(!is_null($existsOrder))
            <button wire:click="sendMail({{ optional($existsOrder)->invoice->id }})" class="btn btn-primary btn-block" >SI</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12"><h5 class="text-info text-center"> <i class="las la-print" style="font-size: 32px;"></i>Enviar boleta al SII e Imprimir factura </h5></div>
        <div class="col-6">
            <button class="btn btn-secondary btn-block close-final-payment">NO</button>
        </div>
        <div class="col-6">

            @if(isset($existsOrder))
            <a target="_blanck" href="{{ route('order.invoice', ['order' => $existsOrder->id, 'tipoPapel'=> 75 ]) }}" class="btn btn-primary btn-block ">Si</a>
            @endif
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12"><h5 class="text-info text-center">¡Venta Realizada con exito! </h5>

        <br>
          <span class="text-center"> Comprobante enviado por correo electrónico.</span>
        <br>
        <br>
        <br>
        <h6 class="text-center">Haga click en el botón  <strong> Nueva Venta</strong> o presione <strong>F1</strong> para continuar.</h6>
        </div>

        <div class="col-6">
            <a  class="btn btn-primary btn-block link-pos text-white" >Nueva venta</a>

        </div>
        <div class="col-6">
            {{-- <button class="btn btn-primary btn-block" >SI</button> --}}
            @if(isset($existsOrder))
            <a target="_blank" href="{{ route('order.invoice', ['order' => $existsOrder->id , 'tipoPapel'=> 75]) }}" class="btn btn-primary btn-block text-white">Imprimir boleta</a>
            @endif
        </div>
    </div>


</div>
@endhandheld
