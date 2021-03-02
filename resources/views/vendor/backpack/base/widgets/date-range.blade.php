<div class="col-12">
    <div class="row {{$widget['content']['wrapperClass']}}">
        <span class="font-weight-bold">{{$widget['content']['title']}}</span>
    </div>
    <div class="row {{$widget['wrapperClass']['row'] ?? ''}}">
        <div class="form-group {{$widget['wrapperClass']['date_width'] ?? 'col-md-12'}}">
            <span>Hasta</span>
            <input type='date' class="form-control" id="date-to" max="{{ today()->toDateString() }}"/>
        </div>
        <div class="form-group {{$widget['wrapperClass']['date_width'] ?? 'col-md-12'}}">
            <span>Desde</span>
            <input type='date' class="form-control" id="date-from" max="{{ today()->toDateString() }}"/>
        </div>
    </div>
</div>
