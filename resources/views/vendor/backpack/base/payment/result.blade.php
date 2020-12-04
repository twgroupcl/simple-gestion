@extends(backpack_view('blank'))
@php
$payment = null;
if(!is_null($subscription->payment)){
$payment = $subscription->payment;
$payment_result = json_decode($payment->json_in);
$payment_result_data = $payment_result->data->detailOutput;
}
@endphp
@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-12 text-center">
                            <h4> Subscripcíon realizada con éxito </h4>
                        </div>
                        <div class="col-12">
                            Plan: {{ $subscription->plan->name }}</h4>
                            <input type="hidden" class="subscription-id" value="{{$subscription->id}}">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-6">Inicia : {{ \Carbon\Carbon::parse($subscription->starts_at)->format('d/m/Y H:i:s') }}</div>
                                <div class="col-6 ">
                                    <div class="float-right"> Finaliza : {{ \Carbon\Carbon::parse($subscription->ends_at)->format('d/m/Y H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                        @if (!is_null($payment))
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-6">Método de pago: {{ $payment->method_title }}</div>
                                    <div class="col-6 float-rigth">
                                        <div class="float-right">
                                            {{ currencyFormat($payment_result_data->amount ? $payment_result_data->amount : 0, 'CLP', true) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 text-center">
                                   <a href="/admin/seller" class="btn btn-primary"> Continuar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
$(function(){
    let subscriptionId = $('.subscription-id').val();
    $.post("{{url('send-email-subscription')}}", {subscriptionId: subscriptionId});
});
</script>
@endpush

