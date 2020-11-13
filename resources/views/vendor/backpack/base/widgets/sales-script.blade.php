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
    <script type="text/javascript"
        src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
    <script>
        let filters = {
            from: '',
            to: ''
        };
        let salesTable;

        function start() {
            $(`#date-to`).val(today)
            $(`#date-from`).val(sevenDaysAgo)

            filters.from = sevenDaysAgo()
            filters.to = today()

            $(`#date-from`).change(() => {
                filters.from = event.target.value
                this.refreshData();
            })

            $(`#date-to`).change(() => {
                filters.to = event.target.value
                this.refreshData();
            })



            salesTable = $('#sales-table').DataTable({

                processing: true,
                serverSide: true,
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                autoWidth: false,
                fixedHeader: true,
                draw: true,
                ajax: {
                    url: '{{route('report.sales') }}',
                    type: 'GET',
                    dataSrc: '',
                    data: {
                        from:  function() { return filters.from },
                        to: function() { return filters.to }
                    },
                },
                columns: [{
                        data: 'id',
                        name: '#'
                    },
                    {
                        data: 'created_at',
                        name: 'Fecha',
                    },
                    {
                        data: 'total',
                        name: 'Total',
                        render: $.fn.dataTable.render.number( '.', ',', 0,'$')
                    },
                    {
                        data: 'totalCommission',
                        name: 'Comisión',
                        render: $.fn.dataTable.render.number( '.', ',', 0,'$')
                    },
                    {
                        data: 'totalFinal',
                        name: 'total',
                        render: $.fn.dataTable.render.number( '.', ',', 0,'$')
                    }
                ],
                columnDefs:[
                    {targets:2, className: 'text-center'
                    },
                    {targets:1, render:function(data){
                        return moment(data).format('DD/MM/Y hh:mm:ss');
                    }},
                    {targets:2, className: 'text-right'
                    },
                    {targets:3, className: 'text-right'
                    },
                     {targets:4, className: 'text-right'
                    }
            ]
            });
        };



        function refreshData() {
            salesTable.ajax.reload();
        }

        start();

    </script>
@endpush
