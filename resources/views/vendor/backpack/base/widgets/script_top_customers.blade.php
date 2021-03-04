@push('after_scripts')

    <script>
        let startInterval
        let dateFrom = $('#date-from').val();
        let dateTo = $('#date-to').val();

        function start_interval() {
            if (Chart.instances) {
                productsChart.refreshData()
                clearInterval(startInterval)
            }
            
        }

        class TopCustomersChart {
            constructor(api, chart, filters) {
                this.api = api;
                this.chart = chart;
                this.filters = filters;
            }

            start() {
                //$(`#date-to`).val(today())
                //$(`#date-from`).val(sevenDaysAgo())

                $(`#date-from`).change(() => {
                    this.filters.from = event.target.value
                    this.refreshData();
                })

                $(`#date-to`).change(() => {
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

        productsChart = new TopCustomersChart(
            '{{ route("charts.top-customers-in-period.index") }}',
            'top-customers-in-period',
            {
                from: dateFrom,
                to: dateTo
            },
        )

        productsChart.updateCanvas = (data, ctx) => {
            //diff = Math.abs(startDay.diff(endDay, 'days')) + 1;
            //period = [...Array(diff).keys()].map(item => moment().subtract(item, 'days').format('YYYY-MM-DD'));
                    let chart_instance;
                        Chart.helpers.each(Chart.instances, function(instance){
                                    if (instance.chart.canvas.id === ctx.canvas.id && data.length > 0) {
                                        let labels = [];
                                        data.forEach((el) => {
                                            labels.push(el.label)
                                        })
                                        //instance.data.labels = labels
                                        instance.data.datasets = data 
                                        instance.options.responsive = true
                                        instance.scales.yAxes = [{ticks: {beginAtZero: true}}]
                                        instance.maintainAspectRatio = false;
                                        instance.update()

                                    }
                                })

                    /*
                    if (data.length > 0) {
                                let myChart = new Chart(ctx, {
                                            type: data[0].type,
                                            data: {
                                                        labels,
                                                        datasets: data
                                                    },
                                            options: {
                                                        "scales":{
                                                                    xAxes: [                                             {
                                                                                display: true,
                                                                                position: 'bottom',
                                                                                id: 'x-axis-2'
                                                                            }],
                                                                        "yAxes":[{"ticks":{"beginAtZero":true}}]
                                                                },
                                                        responsive: true,
                                                        maintainAspectRatio: true,
                                                    },
                                            plugins: []
                                        });
                                */
        }

        
        productsChart.start()

        startInterval = setInterval(start_interval,200)

    </script>
@endpush
