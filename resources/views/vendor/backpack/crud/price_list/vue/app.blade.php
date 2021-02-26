{{-- Styles --}}
@push('before_styles')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vuetify-custom.min.css') }}">

    <style>
        #custom-vue-app .theme--light.v-application {
            background: black !important;
        }
    </style>
@endpush

{{-- App js --}}
@push('after_scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script> --}}

    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vuetify.min.js') }}"></script>
    <script>

        var es = {
            close: 'Close',
            dataIterator: {
                pageText: '{0}-{1} de {2}',
                noResultsText: 'Ningún resultado a mostrar',
                loadingText: 'Loading item...'
            },
            dataTable: {
                itemsPerPageText: 'Filas por página:',
                ariaLabel: {
                sortDescending: ': Sorted descending. Activate to remove sorting.',
                sortAscending: ': Sorted ascending. Activate to sort descending.',
                sortNone: ': Not sorted. Activate to sort ascending.'
                }
            },
            dataFooter: {
                itemsPerPageText: 'Elementos por página:',
                itemsPerPageAll: 'Todos',
                nextPage: 'Página siguiente',
                prevPage: 'Página anterior',
                firstPage: 'Página primera',
                lastPage: 'Página última'
            },
            datePicker: {
                itemsSelected: '{0} seleccionados'
            },
            noDataText: 'Ningún dato disponible',
            carousel: {
                prev: 'Visual previo',
                next: 'Siguiente visual'
            },
            calendar: {
                moreEvents: '{0} más'
            },
            fileInput: {
                counter: '{0} files',
                counterSize: '{0} files ({1} in total)'
            }
        };

        new Vue({
            el: '#app',
            vuetify: new Vuetify({
                lang: {
                    locales: { es },
                    current: 'es',
                },
            }),

            data() {
                return {
                    products: [],
                    search: '',
                    headers: [
                        {
                            text: 'Sku',
                            value: 'sku'
                        },
                        {
                            text: 'Nombre',
                            value: 'name'
                        },
                        {
                            text: 'Costo',
                            value: 'cost'
                        },
                        {
                            text: 'Precio',
                            value: 'price'
                        },
                        {
                            text: 'Actions',
                            value: 'actions',
                            sortable: false
                        },
                    ],
                    desserts: [{
                        name: 'Frozen Yogurt',
                        sku: '159',
                        price: 6.0,
                        cost: 24,
                    }, ],
                }
            },

            methods: {

            },
        })

    </script>
@endpush
