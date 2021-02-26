@extends(backpack_view('blank'))

@section('header')
	<section class="container-fluid mt-5">
	  <h2>
        <span class="text-capitalize">Lista de precios</span>
        <small>editar lista de precio.</small>

        {{-- @if ($crud->hasAccess('list'))
          <small><a href="{{ url($crud->route) }}" class="d-print-none font-sm"><i class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
        @endif --}}
	  </h2>
	</section>
@endsection

@section('content')

    @include('vendor.backpack.crud.price_list.vue.template')
    {{-- <div class="row">
        <div class="col-md-12 bold-labels">
            <div class="card">
                <div class="card-body row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-12 form-group required" element="div">
                                <label>Nombre</label>
                                <input type="text" value="" class="form-control">
                            </div>
                            <div class="col-md-12 form-group required" element="div">
                                <label>Codigo</label>
                                <input type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                </div>

                <div class="card-body row">
                    <div class="col">
                        @include('vendor.backpack.crud.price_list.vue.template')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@include('vendor.backpack.crud.price_list.vue.app')

