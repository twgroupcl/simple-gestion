<div class="row col-md-12 d-flex flex-row-reverse">
    <span class="font-weight-bold">Rango de fechas para productos</span>
</div>
<div class="row col-md-12 d-flex flex-row-reverse">
    <div class="form-group col-sm-2">
        <span>Hasta</span>
        <input type='date' class="form-control" id="most-purchased-products-date-to" max="{{ today()->toDateString() }}"/>
    </div>
    <div class="form-group col-sm-2">
        <span>Desde</span>
        <input type='date' class="form-control" id="most-purchased-products-date-from" max="{{ today()->toDateString() }}"/>
    </div>
</div>