@extends('layouts.base')
@section('content')
    <!-- Page title-->
    <!-- Page Content-->
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h2 class="h4 pb-3">!Operación éxitosa!</h2>
                    @csrf
                    <input type="hidden" class="id_plan_subscription" value="{{$data}}">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function(){
        let token = $("input[name*='_token']").val(),
        idPlanSubscription = $(".id_plan_subscription").val();
        $.post( "{{url('send-email-admin')}}", { idPlanSubscription: idPlanSubscription, _token:token} );
    });
</script>
@endpush

