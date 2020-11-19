<div class="col-md-6 @if(!$widget['visible']) d-none @endif">
<div class="row col-md-12 d-flex">
    <span class="font-weight-bold">Vendedores</span>
</div>
<div class="row col-md-12 ">
    <div class="form-group col-sm-6">
        <span> &nbsp; </span>
        <select id="seller-select2" class="form-control" name="seller">
            <option value="-1" class="text-uppercase" >Todas</option>
            @foreach (collect($sellers) as $seller)
                <option value="{{$seller->id}}" class="text-uppercase">{{$seller->visible_name}}</option>
            @endforeach
          </select>
    </div>

</div>
</div>
