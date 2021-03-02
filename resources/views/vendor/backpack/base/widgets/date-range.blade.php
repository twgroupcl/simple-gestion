<div class="col-12">
    <div class="row {{$widget['content']['wrapperClass']}}">
        <span class="font-weight-bold">Rango de fechas</span>
    </div>
    <div class="row {{$widget['wrapperClass']}}">
        <div class="form-group col-sm-6">
            <span>Hasta</span>
            <input type='date' class="form-control" id="date-to" max="{{ today()->toDateString() }}"/>
        </div>
        <div class="form-group col-sm-6">
            <span>Desde</span>
            <input type='date' class="form-control" id="date-from" max="{{ today()->toDateString() }}"/>
        </div>
    </div>
</div>
