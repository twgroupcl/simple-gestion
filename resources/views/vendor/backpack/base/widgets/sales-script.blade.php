@push('after_scripts')

    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('packages/moment/min/moment.min.js') }}"></script>
    <!-- DATA TABLES SCRIPT -->
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

        const today = () => {
            return moment().format('YYYY-MM-DD');
        }

        const sevenDaysAgo = () => {
            return moment().subtract(6, 'days').format('YYYY-MM-DD');
        }
        let filters = {
            from: '',
            to: '',
            seller: ''
        };
        let salesTable;

        function start() {
            $(`#date-to`).val(today)
            $(`#date-from`).val(sevenDaysAgo)

            filters.from = sevenDaysAgo()
            filters.to = today()
            filters.seller = -1

            $(`#date-from`).change(() => {
                filters.from = event.target.value
                this.refreshData();
            })

            $(`#date-to`).change(() => {
                filters.to = event.target.value
                this.refreshData();
            })

            $('#seller-select2').select2();
            $('#seller-select2').change(() => {
                var data = $("#seller-select2 option:selected").val();
                filters.seller = data;
                console.log(data);
                this.refreshData();
            })

            salesTable = $('#sales-table').DataTable({


                processing: true,
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                dom: 'Bfrtip',
                buttons: {
                    dom: {
                        container: {
                            tag: 'div',
                            className: 'flexcontent'
                        },
                        buttonLiner: {
                            tag: null
                        }
                    },

                    buttons: [


                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-clipboard"></i>Copiar',
                            title: 'Reporte de ventas',
                            titleAttr: 'Copiar',
                            className: 'btn btn-app export barras',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>PDF',
                            title: 'Reporte de ventas pdf',
                            titleAttr: 'PDF',
                            className: 'btn btn-app export pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            },
                            orientation: 'landscape',
                            customize: function(doc) {
                                var colCount = new Array();
                                $('#sales-table').find('tbody tr:first-child td').each(function() {
                                    if ($(this).attr('colspan')) {
                                        for (var i = 1; i <= $(this).attr('colspan'); i++) {
                                            colCount.push('*');
                                        }
                                    } else {
                                        colCount.push('*');
                                    }
                                });
                                doc.content[1].table.widths = colCount;
                            }


                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>Excel',
                            title: 'Reporte de ventas excel',
                            titleAttr: 'Excel',
                            className: 'btn btn-app export excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            },
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>CSV',
                            title: 'Reporte de ventas CSV',
                            titleAttr: 'CSV',
                            className: 'btn btn-app export csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>Imprimir',
                            title: 'Reporte de ventas impresion',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-app export imprimir',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        }
                    ]


                },

                ajax: {
                    url: '{{ route('report.sales') }}',
                    type: 'GET',
                    dataSrc: '',
                    data: {
                        from: function() {
                            return filters.from
                        },
                        to: function() {
                            return filters.to
                        },
                        seller: function() {
                            return filters.seller
                        }
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'Orden N°'
                    },
                    {
                        data: 'seller',
                        name: 'Expositor'
                    },
                    {
                        data: 'created_at',
                        name: 'Fecha',
                    },
                    {
                        data: 'payment',
                        name: 'Tipo Pago',
                    },
                    {
                        data: 'total',
                        name: 'Total',
                        render: $.fn.dataTable.render.number('.', ',', 0, '$')
                    },
                    {
                        data: 'totalCommission',
                        name: 'Comisión',
                        render: $.fn.dataTable.render.number('.', ',', 0, '$')
                    }
                    // ,
                    // {
                    //     data: 'totalFinal',
                    //     name: 'total',
                    //     render: $.fn.dataTable.render.number('.', ',', 0, '$')
                    // }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function(data) {
                                data = '<a href="/admin/order/' + data  + '/edit">' + data + '</a>';
                            return data;
                        },
                        className: 'text-center'
                    },

                    {
                        targets: 2,
                        render: function(data) {
                            return moment(data).format('DD/MM/Y hh:mm:ss');
                        },
                        className: 'text-center'
                    },
                    {
                        targets: 3,
                        className: 'text-center'
                    },
                    {
                        targets: 4,
                        className: 'text-right'
                    },
                    {
                        targets: 5,
                        className: 'text-right'
                    }
                ],

                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };


                    var amountTotal = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var commissionTotal = api
                        .column(5)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // var finalTotal = api
                    //     .column(6)
                    //     .data()
                    //     .reduce(function(a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);


                    // Update footer by showing the total with the reference of the column index
                    $(api.column(2).footer()).html('Total');

                    // $(api.column(3).footer()).html('$' + parseFloat(amountTotal, 10).toFixed(0).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                    $(api.column(4).footer()).html(OSREC.CurrencyFormatter.format(amountTotal, { currency: 'CLP' }) );
                    $(api.column(5).footer()).html(OSREC.CurrencyFormatter.format(commissionTotal,  { currency: 'CLP' }));
                    // $(api.column(5).footer()).html(finalTotal);
                },
                //  }
            });



        };



        function refreshData() {
            salesTable.ajax.reload();
        }

        start();

    </script>
@endpush
