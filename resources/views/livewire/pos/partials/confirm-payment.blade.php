@handheld
<div class="col-12 confirm-payment-view" style="display: none;">
</div>
@elsehandheld
<div class="col-11 confirm-payment-view" style="display: none;">
    <div class="row">
        <div class="col-12"><i class="la la-close float-right close-confirm-payment" ></i></div>
    </div>
    <div class="row">
        <div class="col-12"><h5 class="text-info text-center">Este proceso generará una nueva orden y una factura electrónica.</h5></div>
    </div>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-secondary btn-block close-confirm-payment">NO</button>
        </div>
        <div class="col-6">
            <button class="btn btn-primary btn-block" id="confirm-payment" >SI</button>
        </div>
    </div>
</div>
@endhandheld
