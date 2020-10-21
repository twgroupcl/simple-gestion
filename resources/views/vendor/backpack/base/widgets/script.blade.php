@push('after_scripts')
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('packages/moment/min/moment.min.js') }}"></script>

    <script>
        const today = () => {
            return moment().format('YYYY-MM-DD');
        }

        const sevenDaysAgo = () => {
            return moment().subtract(6, 'days').format('YYYY-MM-DD');
        }

        class MarketChart {
            constructor(api, chart, filters) {
                this.api = api;
                this.chart = chart;
                this.filters = filters;
            }

            start() {
                $(`#${this.chart}-date-to`).val(today())
                $(`#${this.chart}-date-from`).val(sevenDaysAgo())

                this.filters.from = sevenDaysAgo()
                this.filters.to = today()

                $(`#${this.chart}-date-from`).change(() => {
                    this.filters.from = event.target.value
                    this.refreshData();
                })

                $(`#${this.chart}-date-to`).change(() => {
                    this.filters.to = event.target.value
                    this.refreshData();
                })
            };

            getQueryParams() {
                return '?' + Object.keys(this.filters)
                    .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(this.filters[key])}`)
                    .join('&');
            }

            async refreshData() {
                console.log(this.filters)
                let qs = this.getQueryParams();

                let headers = {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                };

                let response = await fetch(this.api+qs, {
                    headers: headers,
                });

                let data = await response.json();
                let ctx = $(`.${this.chart}`).find('canvas')[0].getContext('2d');

                this.updateCanvas(data, ctx);
            }
        }

            productsChart = new MarketChart(
                '{{ route("charts.most-purchased-products.index") }}',
                'most-purchased-products',
                {
                    from: '',
                    to: ''
                },
            )

            productsChart.updateCanvas = (data, ctx) => {
                // console.log(productsChart.filters.from)
                // console.log(productsChart.filters.to)
                // console.log(data)
                startDay = moment(productsChart.filters.from)
                endDay = moment(productsChart.filters.to)
                diff = Math.abs(startDay.diff(endDay, 'days')) + 1;
                period = [...Array(diff).keys()].map(item => moment().subtract(item, 'days').format('YYYY-MM-DD'));

                Chart.helpers.each(Chart.instances, function(instance){
                    if (instance.chart.canvas.id === ctx.canvas.id) {
                        instance.destroy()
                    }
                })

                let myChart = new Chart(ctx, {
                        type: data[0].type,
                        data: {
                            labels: period.reverse(),
                            datasets: data
                        },
                        options: {"maintainAspectRatio":false,"scales":{"xAxes":[],"yAxes":[{"ticks":{"beginAtZero":true}}]}},
                        plugins: []
                });
            }

            productsChart.start()

            productsCategoriesChart = new MarketChart(
                '{{ route("charts.most-purchased-product-categories.index") }}',
                'most-purchased-product-categories',
                {
                    from: '',
                    to: ''
                },
            )

            productsCategoriesChart.updateCanvas = (data, ctx) => {
                Chart.helpers.each(Chart.instances, function(instance){
                    if (instance.chart.canvas.id === ctx.canvas.id) {
                        instance.destroy()
                    }
                })

                var myChart = new Chart(ctx, {
                        type: data[0].type,
                        data: {
                            labels: data[0].label.split(';'),
                            datasets: data
                        },
                        options: {"maintainAspectRatio":false,"scales":{"xAxes":[{"display":false}],"yAxes":[{"ticks":{"beginAtZero":true},"display":false}]},"legend":{"display":true}},
                        plugins: []
                    });
            }

            productsCategoriesChart.start()
    </script>
@endpush