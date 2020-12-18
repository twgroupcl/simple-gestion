@extends(backpack_view('layouts.top_left'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    $crud->entity_name_plural => url($crud->route),
    'Salesreport' => false,
  ];

  $date = now();
  $month = $date->format('m');
  $year = $date->format('Y');

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <section class="container-fluid">
    <h2>
        {{-- <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
        <small>{!! $crud->getSubheading() ?? 'Moderate '.$crud->entity_name !!}.</small>

        @if ($crud->hasAccess('list'))
          <small><a href="{{ url($crud->route) }}" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
      @endif--}}
    </h2>
  </section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Generar reporte de ventas</h3>
            </div>
            <div class="card-body row">
                <form method="POST" action="{{'dte_sales_report'}}">
                    @csrf
                    <div class="col-md-12">
                        <label> Mes:
                            <input name="period_month" type="number" min="1" max="12" value="{{$month}}" />
                        </label>
                    </div>

                    <div class="col-md-12">
                        <label> Año:
                            <input name="period_year" type="number" min="2019" max="2080" value="{{$year}}" />
                        </label>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Exportar</button>
                    </div>
                </form>
                
            </div><!-- /.card-body -->

            <div class="card-footer">
            </div><!-- /.card-footer-->
          </div><!-- /.card -->
          </form>
    </div>
</div>
@endsection

