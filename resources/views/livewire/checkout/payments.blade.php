<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="accordion mb-2" id="payment-method" role="tablist">
    @foreach ($payments as $payment)




            <div class="card">
              <div class="card-header" role="tab">
                <h3 class="accordion-heading"><a class="" href="#{{$payment->code}}" data-toggle="collapse" aria-expanded="true"><i class="czi-paypal mr-2 align-middle"></i>{{$payment->title}}<span class="accordion-indicator"></span></a></h3>
              </div>
              <div class="collapse show" id="{{$payment->code}}" data-parent="#payment-method" role="tabpanel" style="">
                <div class="card-body font-size-sm">
                  <p><span class="font-weight-medium">{{$payment->title}}</span> </p>
                  <button class="btn btn-primary" type="button" wire:click="goPay">Realizar pago</button>
                </div>
              </div>
            </div>


    @endforeach
    </div>
</div>
