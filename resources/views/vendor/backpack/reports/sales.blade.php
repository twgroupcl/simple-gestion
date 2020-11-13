
@php

Widget::add()->to('after_content')->type('div')->class('row')->content([
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets
            [ 'type' => 'simple-text', 'content' => '<h3>Reporte de Ventas</h3>'],
        ]
    ]),
    //break
    Widget::add([
        'type' => 'div',
        'class'   => 'w-100 d-none d-md-block',
    ]),
    Widget::add([
        'type' => 'div',
		'class' => 'w-100',
		'content' => [
				[
					'type'    => 'script',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Scripts',
				],
				[
					'type'    => 'date-range',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Rango de fechas',
				]
			]
    ]),
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets
                [
                    'type' => 'subscription',
                    'content' => $subscriptionPlan
                ],
        ]
    ]),
     //break
     Widget::add([
        'type' => 'div',
        'class'   => 'w-100 d-none d-md-block',
    ]),
    Widget::add([
        'name'        => 'table',
        'type'        => 'div',
        'class'       => ' w-100',
        'content'       =>[
            [
            'name'        => 'table',
            'type'        => 'table',
            'id'          => 'sales-table',
            'class'       => 'w-100 table table-bordered ',
            'columns'     => [
                'id' => '#',
                'created_at' => 'Fecha',
                'total' => 'Importe',
                'totalCommission' => 'Comisión',
                'totalFinal' => 'Total',
            ],
            'collection'  => $data]
        ]

    ]),
    // Widget::add([
    //     'name' => 'export_buttons',
    //     'type' => 'export_buttons',

    // ]),
    Widget::add([
        'name' => 'sales-script',
        'type' => 'sales-script',

    ]),
]);

@endphp

