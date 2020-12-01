
@php

$isAdmin = backpack_user()->hasAnyRole('Super admin|Admin filsa|Contador filsa');

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
		'class' => 'row w-100',
		'content' => [

				[
					'type'    => 'select2-seller',
					'wrapper' => ['class' => 'col-6'],
                    'collection' => $sellers,
                    'visible' => $isAdmin
				],
				[
					'type'    => 'date-range',
					'wrapper' => ['class' => 'col-6'],
					'content' => 'Rango de fechas',
				]
			]
    ]),

    // Widget::add([
    //     'type' => 'div',
    //     'class'   => 'row ',
    //     'content' => [ // widgets
    //             [
    //                 'type' => 'subscription',
    //                 'content' => $subscriptionPlan
    //             ],
    //     ]
    // ]),
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
                'id' => 'Orden N°',
                'exhibitor' => 'Expositor',
                'created_at' => 'Fecha',
                'payment' => 'Tipo Pago',
                'total' => 'Total venta',
                'totalCommission' => 'Comisión Market',

            ],
            'collection'  => $data]
        ]

    ]),

    Widget::add([
        'name' => 'sales-script',
        'type' => 'sales-script',

    ]),

]);

@endphp

