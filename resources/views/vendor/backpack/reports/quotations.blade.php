@extends(backpack_view('blank'))
@section('content')

{{-- Encabezado --}}
<div class="mb-4">
    <h3>Reporte de cotizaciones</h3>
</div>

{{-- Filtros --}}
<div class="row mb-3">

    {{-- Fecha desde --}}
    <div class="col-md-2">
        <span>Desde</span>
        <input type="date" class="form-control" id="date-from" name="date-from" value="">
    </div>

    {{-- Fecha hasta --}}
    <div class="col-md-2">
        <span>Hasta</span>
        <input type="date" class="form-control" id="date-to" name="date-to">
    </div>

    {{-- Estado de cotizacion --}}
    <div class="col-md-2 form-group">
        <span>Estado de la cotización</span>
        <select name="quotation-status" id="quotation-status" class="form-control">
            <option value="all">Todos</option>
            <option value="{{ App\Models\Quotation::STATUS_DRAFT }}">BORRADOR</option>
            <option value="{{ App\Models\Quotation::STATUS_SENT }}">ENVIADO</option>
            <option value="{{ App\Models\Quotation::STATUS_VIEWED }}">VISTO</option>
            <option value="{{ App\Models\Quotation::STATUS_EXPIRED }}">EXPIRADO</option>
            <option value="{{ App\Models\Quotation::STATUS_ACCEPTED }}">ACEPTADO</option>
            <option value="{{ App\Models\Quotation::STATUS_REJECTED }}">RECHAZADO</option>
            <option value="{{ App\Models\Quotation::STATUS_ISSUED }}">EMITIDO</option>
            <option value="{{ App\Models\Quotation::STATUS_INVOICED }}">FACTURADO</option>

        </select>
    </div>
</div>

{{-- Tabla --}}
<div>
    <table id="quotations-report" class="w-100 table table-bordered">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th>$ 0</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('after_styles')
    <!-- SELECT2-->
  <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css') }}">
  <style>
      .dt-buttons {
          display: block !important;
      }
  </style>
@endpush

@push('after_scripts')

    {{-- Select2 and momment.js plugins --}}
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('packages/moment/min/moment.min.js') }}"></script>


    <!-- DATA TABLES SCRIPTS -->
    <script type="text/javascript" src="{{ asset('packages/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('packages/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>

    {{-- Datatable buttons --}}
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/currencyformatter.js/2.2.0/currencyFormatter.min.js" integrity="sha512-zaNuym1dVrK6sRojJ/9JJlrMIB+8f9IdXGzsBQltqTElXpBHZOKI39OP+bjr8WnrHXZKbJFdOKLpd5RnPd4fdg==" crossorigin="anonymous"></script>

    <script> 
        /**********************************************
        *  
        * Varaiables
        *
        ***********************************************/

        let filters = {
            from: '',
            to: '',
            quotation_status: '',
        };

        let spanish = {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %d fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "1": "Mostrar 1 fila",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "not": "No",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio"
                    },
                    "moment": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "not": "No",
                        "notBetween": "No entre",
                        "notEmpty": "No vacio"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "not": "No",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "not": "No",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d"
            },
            "select": {
                "1": "%d fila seleccionada",
                "_": "%d filas seleccionadas",
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "$d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                }
            },
            "thousands": "."
        }  


        /**********************************************
        *  
        * Functions
        *
        ***********************************************/

        function init() {
            let today = moment().format('YYYY-MM-DD');
            let sevenDaysAgo = moment().subtract(6, 'days').format('YYYY-MM-DD');
            $('#date-from').val(sevenDaysAgo)
            $('#date-to').val(today)
        }

        function formatNumber(number) {
            if (typeof number == 'number') {
                number = parseFloat(number).toFixed(2);
            }
            
            number = parseFloat(number).toFixed(0)
            number = number.replace('.', ',')
            number = number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return number;
        }

        function sanitazeNumber(string) {
            string = string.toString();
            let number  = string.replaceAll('$', '')
            number = number.toString()
            number = number.replaceAll('.', '')
            return parseInt(number)
        }

        function loadData() {
            quotationTable.ajax.reload();
        }


        /**********************************************
        *  
        * Document ready
        *
        ***********************************************/
        $(document).ready( function () {

            init()

            quotationTable = $('#quotations-report').DataTable({
                language: spanish,
                ajax: {
                    url: '{{ route('report.quotations.load-data') }}',
                    type: 'GET',
                    dataSrc: '',
                    data: {
                        from: function() {
                            return filters.from
                        },
                        to: function() {
                            return filters.to
                        },
                        status: function() {
                            return filters.quotation_status
                        }
                    },
                },
                columns: [
                    { data: 'id' },
                    { data: 'quotation_date' },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'quotation_status' },
                    { data: 'total' }
                ],
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copyHtml5', footer: true },
                    { extend: 'excelHtml5', footer: true },
                    { extend: 'csvHtml5', footer: true },
                    { extend: 'pdfHtml5', footer: true }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce( function (a, b) {
                            return sanitazeNumber(a) + sanitazeNumber(b);
                        }, 0 );
        
                    // Total over this page
                    pageTotal = api
                        .column(5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return sanitazeNumber(a) + sanitazeNumber(b);
                        }, 0 );
        
                    // Update footer
                    $( api.column(5).footer() ).html(
                        //'$ ' + formatNumber(pageTotal) +' ($ ' + formatNumber(total) + ' total)'
                        '$ ' + formatNumber(pageTotal)
                    );
                }
            })

            loadData()
        });


        /**********************************************
        *  
        * Event listeners
        *
        ***********************************************/

        $('#date-from, #date-to, #quotation-status').on('change', function () {
            filters.quotation_status = $('#quotation-status').val();
            filters.from = $('#date-from').val()
            filters.to = $('#date-to').val()
            loadData()
        })

        
    </script>
@endpush