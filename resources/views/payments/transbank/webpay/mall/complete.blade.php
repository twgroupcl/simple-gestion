@extends('layouts.base')
@section('content')
    <!-- Page title-->
    <!-- Page Content-->
    <div class="container pb-5 mb-sm-4">
      <div class="pt-5">
        <div class="card py-3 mt-sm-3">
          <div class="card-body text-center">
            <h2 class="h4 pb-3">Gracias por su pedido!</h2>
            <p class="font-size-sm mb-2">Su pedido ha sido realizado y será procesado tan pronto como sea posible.</p>
            <p class="font-size-sm mb-2">Asegúrese de anotar su número de pedido, que es <span class='font-weight-medium'>#{{$order->id}}</span></p>
            <p class="font-size-sm">Recibirá un correo electrónico en breve con la confirmación de su pedido. <u>Ahora puedes:</u></p><a class="btn btn-secondary mt-3 mr-3" href="shop-grid-ls.html">Volver a comprar</a><a class="btn btn-primary mt-3" href="{{route('transbank.webpayplus.mall.download', ['order' => $order->id])}}">&nbsp;Descargar orden</a>
          </div>
        </div>
      </div>
    </div>
@endsection
