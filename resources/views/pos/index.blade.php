@extends(backpack_view('blank'))

@section('content')
    @livewire('pos.pos')
@endsection

@section('before_scripts')
    @livewireScripts
@endsection