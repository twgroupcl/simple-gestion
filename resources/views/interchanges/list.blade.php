@extends(backpack_view('layouts.top_left'))
@section('content')

<div class="mb-4">
    <h3>Procesar intercambios</h3>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <h5>Datos del intercambio:</h5>
        <p><small>Seleccione los documentos que quiere responder </small></p>
        <label for="selection-status-dte"> Enviar seleccionados con el estado: </label>
        <select id="selection-status-dte" class="form-control col-md-3 mb-3" name="status-selection-dte" required>
            <option value="ERM">Otorga recibo de mercaderías o servicios</option>
            <option value="ACD">Acepta contenido del documento</option>
            <option value="RCD">Reclamo al contenido del documento</option>
            <option value="RFP">Reclamo por falta parcial de mercaderías</option>
            <option value="RFT">Reclamo por falta total de mercaderías</option>
        </select>
        <label for="period-dte"> Periodo <small class=""> Ingrese el periodo con formato año seguido del mes (Ejemplo: 202106)</small></label>
        <input id="period-dte" class="form-control col-md-3 mb-3"  placeholder="202106" required />
        <button id="buttonSend" class="btn btn-primary btn-sm">Enviar</button>
    </div>
    <div class="col-md-6">
        <h5>Filtros:</h5>
        <div class="col-md-8 form-group">
        <span>Estado</span>
        <select name="filter-interchange-status" id="filter-interchange-status" class="form-control">
            <option value="all">Todos</option>
            <option value="1">Pendientes</option>
            <option value="0">Conforme</option>
        </select>
        </div>
        {{-- Fecha desde --}}
        <div class="col-md-6">
            <span>Desde</span>
            <input type="date" class="form-control" id="date-from" name="date-from" value="">
        </div>

        {{-- Fecha hasta --}}
        <div class="col-md-6">
            <span>Hasta</span>
            <input type="date" class="form-control" id="date-to" name="date-to">
        </div>
    </div>
</div>
<table id="interchanges-report" class="w-100 table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection

@push('after_styles')
    <!-- SELECT2-->
  <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
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
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('packages/datatables.net-responsive/js/dtaTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="ext/javascript"
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
            filter_interchange_status: '',
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
                    "_": "%d celdas seleccionadas"
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
            let startDate = moment().startOf('month').format('YYYY-MM-DD');
            $('#date-from').val(startDate)
            $('#date-to').val(today)
        }
        function loadData() {
            interchangeTable.ajax.reload();
        }
        /**********************************************
        *  
        * Document ready
        *
        ***********************************************/
        $(document).ready( function () {
            init()
            interchangeTable = $('#interchanges-report').DataTable({
                language: spanish,
                ajax: {
                    url: '{{ route('dte.interchanges.load-data') }}',
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
                            console.log(
                            filters.filter_interchange_status, 'qweqwe')
                            return filters.filter_interchange_status;
                        }
                    }
                },
                "columnDefs": [ 
                    //{
                    //    "targets": -1,
                    //    "data": null,
                    //    //"defaultContent": "<input type=\"checkbox\" class=\"btn btn-lnk\"><i class=\"nav-icon fas fa-eye\"></i> </button>"
                    //    "defaultContent": "<input type=\"checkbox\" class=\"btn btn-lnk\" />"
                    //},
                    
                    {
                        "targets":[1, 2, 3, 4, 5],
                        "visible": false,
                        "searcheable": false
                    }
                ],
                select: { 
                    selector: 'td:first-child',
                    style: 'multi'
                },
                columns: [
                    {
                        orderable: false,
                        checkboxes: {
                            selectRow: true
                        },
                        className: 'select-checkbox',
                        targets: 0 ,
                        data: null,
                        defaultContent: '',
                        //render: function(data, type, row) {
                        //    console.log(data,type,row)
                        //    if (type === 'display') {
                        //        return '<input type="checkbox" class="editor-active">';
                        //    }
                        //    return data;
                        //}
                    },
                    { data: 'interchange_code' },
                    { data: 'emitter_rut' },
                    { data: 'receiver' },
                    { data: 'receiver_address' },
                    { data: 'receiver_rut' },
                    { data: 'dte_type' },
                    { data: 'folio' },
                    { data: 'emitter'},
                    { data: 'emit_date'},
                    { data: 'net' },
                    { data: 'iva' },
                    { data: 'total' },
                    { data: 'status' },
                ],
                dom: 'Bfrtip',
                buttons: [
                    //{
                    //    text: 'Enviar',
                    //    action: 
                    //},
                    //{ extend: 'copyHtml5', footer: true },
                    //{ extend: 'excelHtml5', footer: true },
                    //{ extend: 'csvHtml5', footer: true },
                    //{ extend: 'pdfHtml5', footer: true }
                ]
            })
            //interchangeTable.on('select', function (e, dt, type, indexes) {
            //    console.log(interchangeTable.rows('.selected').data())
            //})
            //interchangeTable.on('deselect', function (e, dt, type, indexes) {
            //    console.log(interchangeTable.rows('.selected').data())
            //})
            //$('#interchanges-report tbody').on( 'click', '.select-checkbox', function () {
            //    var data = interchangeTable.row( $(this).parents('tr') ).data();
            //    console.log($(this).prop('checked'))
            //    list[data['interchange_code']] = {
            //        'dte_type': data.dte_type,
            //        'folio':data.folio,
            //        'emitter': data.emitter
            //    };
            //    console.log(list);
            //    //alert(data['interchange_code']);
            //    //window.location = "/admin/dte/interchanges/" + data['code'] + "/view";
            //});
            loadData()
            let buttonSend = $("#buttonSend");
            buttonSend.on('click', function ( e) {
                if (!confirm( 'Está seguro que desea enviar?' )) {
                    return;
                }
                let sendOption = $("#selection-status-dte").val();
                let period = $("#period-dte").val();
                if(sendOption === undefined || (sendOption !== "ERM" && sendOption !== "ACD" && sendOption !== "RCD" && sendOption !== "RFP" && sendOption !== "RFT")) {
                    new Noty({
                        'type': 'error',
                        'text': 'Verifique nuevamente el estado.',
                    }).show()
                    return;
                }
                if(period === undefined || period.length == 0) {
                    new Noty({
                        'type': 'error',
                        'text': 'No indico el periodo',
                    }).show()
                    return;
                }
                let selected = interchangeTable.rows('.selected').data();
                if(selected === undefined || selected.length == 0) {
                    new Noty({
                        'type': 'error',
                        'text': 'Debe seleccionar al menos 1 documento.',
                    }).show()
                    return;
                }
                let documents = [];
                for (let i=0; i < selected.length ;i++) {
                   documents.push(selected[i]);
                }
                let data = {
                    "documents": documents,
                    "sendOption": sendOption,
                    "period": period
                };
                $(this).prop('disabled', true);
                $.ajax({
                    method: 'POST',
                    url: '{{ route('dte.interchanges.send') }}',
                    data,
                    success: function(resp) {
                        new Noty({
                            'type': 'success',
                            'text': 'Se han enviado los documentos. Revise sus estados.',
                        }).show()
                        //$.each(resp, (code, value) => {
                        //    interchangeTable.rows('.selected').data().each((item) => {
                        //        if (code != item.interchange_code) {
                        //            return;
                        //        }
                        //    })
                        //})
                        //console.log(resp)
                        loadData();
                        buttonSend.prop('disabled', false);
                        return;
                    },
                    error: function(resp) {
                        new Noty({
                            'type': 'error',
                            'text': 'Hubo un problema al enviar los documentos.',
                        }).show()
                        loadData();
                        buttonSend.prop('disabled', false);
                        return;
                    }
                })
            }); // end button clcik
        });
        /**********************************************
        *  
        * Event listeners
        *
        ***********************************************/
        $('#date-from, #date-to, #filter-interchange-status').on('change', function () {
            filters.from = $('#date-from').val()
            filters.to = $('#date-to').val()
            filters.filter_interchange_status = $('#filter-interchange-status').val();
            console.log(filters.filter_interchange_status)
            //filters.from = $('#date-from').val()
            //filters.to = $('#date-to').val()
            loadData()
        })
        
    </script>
@endpush
