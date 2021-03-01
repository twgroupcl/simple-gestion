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
                    priceList: {
                        id: {{ $priceList->id }},
                        name: '{{ $priceList->name }}',
                        code: {{ $priceList->code }},
                    },
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

            filters: {

                formatNumberFilter(value) {
                    if (value === null) return null
                    value = Number(value)
                    return value.toLocaleString('de-DE') // Not using 'es-ES' because bug with numbers for 4 digits
                },
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
                        price: this.formatNumber(item.price),
                        cost: this.formatNumber(item.cost),
                    }

                    afterRender(() => {
                        this.$refs.modalFieldPrice.$refs.input.focus();
                    })
                },

                updateProduct() {
                    this.dialog = false
                    let product = this.products.find( product => product.id == this.selectedProduct.id)
                    product.price = this.deformatNumber(this.selectedProduct.price)
                    product.cost = this.deformatNumber(this.selectedProduct.cost)
                    product.changed = true
                },

                async saveChanges() {
                    const url = "{{ route('price-list.api.update', ['id' =>  $priceList->id]) }}"
                    
                    const data = {
                        name: this.priceList.name,
                        code: this.priceList.code,
                        products: this.products.filter( item => item.changed)
                    }

                    const options = {
                        method: 'PUT', 
                        body: JSON.stringify(data), 
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }
                    
                    let response = await fetch(url, options)
                    let responseData = response.json()

                    if (response.status != 200) {
                        new Noty({
                            type: "error",
                            text: "<strong>Ocurrio un error actualizando la lista de precios.</strong>"
                        }).show();
                    } else {
                        new Noty({
                            type: "success",
                            text: "<strong>Lista de precios actualizada correctamente.</strong>"
                        }).show();
                    }
                },

                formatNumber(value) {
                    if (value === null) return null
                    value = Number(value)
                    return value.toLocaleString('de-DE') // Not using 'es-ES' because bug with numbers for 4 digits
                },

                deformatNumber (value) {
                    if (value === null) return null
                    value = value.toString()
                    return value.replaceAll('.', '').replaceAll(',', '.')
                }
            },

           watch: {
                'selectedProduct.price': function () {
                    let price  = this.deformatNumber(this.selectedProduct.price)
                    this.selectedProduct.price = this.formatNumber(price)
                },

                'selectedProduct.cost': function () {
                    let cost  = this.deformatNumber(this.selectedProduct.cost)
                    this.selectedProduct.cost = this.formatNumber(cost)
                }
            }, 

            mounted: function () {
                this.loadProducts();
            },
        })

    </script>
@endpush
