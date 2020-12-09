@extends(backpack_view('blank'))
@section('content')
<div class="container-fluid animated fadeIn">
    <div class="row mt-5 ">
        <div class="col-8 mx-auto">
            <div class="row">
                <div class="col-12">

                    <h1 class="woocommerce-thankyou-order-received h4 pb-3 text-center">Lo sentimos , tu operación no pudo ser realizada</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                       <div class="pt-5">
                        <div class="card py-3 mt-sm-3">
                            <div class="card-body text-center">

                                <p class="font-size-sm mb-2">Encontramos un error en la operación. por favor intenta nuevamente.
                                </p>

                                <a class="btn btn-primary mt-3"  href="{{ route('payment.subscription', ['id' => $result->buyOrder]) }}" >Intenta nuevamente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

