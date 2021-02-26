{{-- Styles --}}
@push('before_styles')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vuetify-custom.min.css') }}">

    <style>
        #custom-vue-app .theme--light.v-application {
            background: none !important;
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

        // Excecute a callback after the DOM was render
        function afterRender(callback) {
            requestAnimationFrame(() => {
                requestAnimationFrame(callback)
            })
        }

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
                    dialog: false,
                    search: '',             
                    headers: [
                        {
                            text: 'SKU',
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
                    products: [],
                    selectedProduct: {},
                }
            },

            methods: {           
                async loadProducts() {
                    response = await fetch("{{ route('price-list.api.products', ['id' =>  $priceList->id]) }}")
                    response = await response.json()
                    this.products = response.map(product => {
                        product.changed = false
                        return product
                    })
                },

                openEditModal(item) {
                    this.dialog = true

                    this.selectedProduct = {
                        id: item.id,
                        price: item.price,
                        cost: item.cost,
                    }

                    afterRender(() => {
                        this.$refs.modalFieldPrice.$refs.input.focus();
                    })
                },

                updateProduct(selectedProduct) {
                    this.dialog = false
                    let product = this.products.find( product => product.id == selectedProduct.id)
                    product.price = selectedProduct.price
                    product.cost = selectedProduct.cost
                },
            },

            mounted() {
                this.loadProducts();
            },
        })

    </script>
@endpush
