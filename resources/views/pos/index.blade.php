@extends(backpack_view('blank'))

@section('content')
    <div id="pos">
        @livewire('pos.pos')
    </div>
@endsection

@section('before_scripts')
    @livewireScripts
@endsection

@section('after_scripts')
<script>
    $('#pos').parent().removeClass('container-fluid')
</script>
@endsection