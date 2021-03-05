@extends(backpack_view('blank'))

@php
use App\Models\Product;
use App\Models\Seller;
use App\User;

    //color cards
    $gray = 'border-dark text-dark bg-gray';
    $white = 'border-dark text-black bg-white';

	$user = backpack_user();
	if ($user->hasRole('Vendedor marketplace')) {
		$seller = Seller::firstWhere('user_id', $user->id);
		$productCount = Product::where('seller_id', $seller->id)->count();
		$selletCount = \App\Models\Seller::count();

		Widget::add()->to('before_content')->type('div')->class('row')->content([
			Widget::make([
				'type' => 'progress',
				'class'=> 'card border-0 text-black bg-light',
				'progressClass' => 'progress-bar',
				'value' => $productCount,
				'description' => 'Productos.',
				'progress' => (int)$productCount/75*100,
			]),
		]);
	}
	else {
		$productCount = \App\Models\Product::count();
		$selletCount = \App\Models\Seller::count();
		$userCount = \App\User::count();

		Widget::add()->to('before_content')->type('div')->class('row')->content([
			// notice we use Widget::make() to add widgets as content (not in a group)
			// Widget::make([
			// 	'type' => 'progress',
			// 	'class' => 'card border-0 text-white bg-primary',
			// 	'progressClass' => 'progress-bar',
			// 	'value' => $userCount,
			// 	'description' => 'Usuarios.',
			// 	'progress' => 100*(int)$userCount/1000,
			// ]),

			Widget::make([
				'type' => 'card',
				'class'=> 'card col-6 text-center ' . $gray,
                'content' => [
                    'header' => 'Productos disponibles',
                    'body' => '<h3>' . $productCount . '</h3>',
                ],
			]),

			// Widget::make([
			// 	'type' => 'progress',
			// 	'class'=> 'card border-0 text-white bg-success',
			// 	'progressClass' => 'progress-bar',
			// 	'value' => $selletCount,
			// 	'description' => 'Negocios.',
			// 	'progress' => (int)$selletCount/75*100,
			// ]),
		]);
	}

	$isAdmin = backpack_user()->hasRole('Super admin');

	if ($isAdmin) {
		$widgets['before_content'][] = [
		'type' => 'div',
		'class' => 'row',
		'content' => [
				[
					'type'    => 'script',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Scripts',
				],
                [
					'type'    => 'script_top_customers',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Script customer',
				],
				[
					'type'    => 'date-range',
                    'wrapperClass' => [
                        'row' => 'd-flex flex-row-reverse',
                        'date_width' => 'col-sm-2',
                    ],
					'content' => [
                        'title' => 'Rango de fechas',
                        'wrapperClass' => 'col-md-12 d-flex flex-row-reverse',
                    ],
				],
                [
                    'type' => 'div',
                    'class' => 'row col-md-6',
                    'content' => [
                        [
                            'type' => 'card_from_ajax',
                            'name' => 'salesByPeriod',
                            'url' => '/admin/api/invoice/salesbyperiod',
                            //'attribute' => 'count',
                            'wrapperClass' => 'col-md-6',
                            'class'=> 'card ' . $white,
                            'content'=> [
                                'header' => '<strong>Ventas en el periodo</strong>',
                                //'body' => 'algo',
                            ],
                        ],
                        [
                            'name' => 'generalQuotations',
                            'type' => 'card_from_ajax',
                            'url' => '/admin/api/quotation/generalStatus',
                            //'attribute' => 'count',
                            'wrapperClass' => 'col-md-6',
                            'class'=> 'card ' . $gray,
                            'content'=> [
                                'header' => '<strong>Cotizaciones</strong>',
                                //'body' => 'algo',
                            ],
                        ],
                        [
                            'type' => 'div',
                            'class' => 'w-100',
                            'content' => []
                        ],
                        [
                            'name' => 'quotationsByStatus',
                            'type' => 'card_from_ajax',
                            'url' => '/admin/api/quotation/bystatus',
                            //'attribute' => 'count',
                            'wrapperClass' => 'col-md-12',
                            'class'=> 'card text-center ' . $white,
                            'content'=> [
                                'header' => '<strong>Cotizaciones por estado</strong>',
                                //'body' => 'algo',
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'chart',
					'wrapperClass' => 'col-md-6 top-customers-in-period',
                    'controller' => \App\Http\Controllers\Admin\Charts\TopCustomersInPeriodChartController::class,
                    'content' => [
                        'header' => 'Top 10 de Clientes en el periodo',
                    ],
                ],
                [
                    'name' => 'Top 10 productos',
                    'type' => 'table_ajax',
                    'wrapper' => [
                        'class' => 'col-6',
                    ],
                    'tableClass' => 'table-striped table-hover table-bordered',
                    'tableHeadClass' => 'thead-dark',
                    'attributes' => [
                        'sku',
                        'invoice_item_total',
                    ],
                    'columns' => [
                        'SKU',
                        'Total',
                    ],
                    'collection' => null,
                    'url' => '/admin/api/product/top_table_dashboard',
                ],
                [
                    'name' => 'Mejores clientes del periodo',
                    'type' => 'table_ajax',
                    'wrapper' => [
                        'class' => 'col-6',
                    ],
                    'tableClass' => 'table-striped table-hover table-bordered',
                    'tableHeadClass' => 'thead-dark',
                    'attributes' => [
                        'uid',
                        'full_name',
                        'buy_total',
                    ],
                    'columns' => [
                        'RUT',
                        'Nombre',
                        'Monto',
                    ],
                    'collection' => null,
                    'url' => '/admin/api/customer/top_table_dashboard',
                ],
				[
					'type'    => 'most-purchased-product-categories',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Filtros de categorías',
				],
				[
					'type' => 'chart',
					'wrapperClass' => 'col-md-6 daily-sales',
					'controller' => \App\Http\Controllers\Admin\Charts\DailySalesChartController::class,
					'content' => [
						'header' => 'Ventas por día',
					]
				],
				[
					'type' => 'chart',
					'wrapperClass' => 'col-md-6 most-purchased-product-categories',
					'controller' => \App\Http\Controllers\Admin\Charts\MostPurchasedProductCategoriesChartController::class,
					'content' => [
						'header' => '10 Categorías más compradas',
					]
				],
				[
					'type'    => 'most-purchased-products',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Filtros',
				],
				[
					'type' => 'chart',
					'wrapperClass' => 'col-md-12 most-purchased-products',
					'controller' => \App\Http\Controllers\Admin\Charts\MostPurchasedProductsChartController::class,
					'content' => [
						'header' => '10 Productos más vendidos',
					]
				],
			]
		];
	} else {
		$widgets['before_content'][] = [
			'type' => 'div',
			'class' => 'row',
			'content' => [
					[
						'type'    => 'script',
						'wrapper' => ['class' => 'col-sm-12'],
						'content' => 'Scripts',
					],
                    [
                        'type' => 'card',
                        'content'=> [
                            'header' => 'Hola',
                        ]
                    ],
					[
						'type'    => 'most-purchased-products',
						'wrapper' => ['class' => 'col-sm-12'],
						'content' => 'Filtros',
					],
					[
						'type' => 'chart',
						'wrapperClass' => 'col-md-6 daily-sales',
						'controller' => \App\Http\Controllers\Admin\Charts\DailySalesChartController::class,
						'content' => [
							'header' => 'Ventas por día',
						]
					],
					[
						'type' => 'chart',
						'wrapperClass' => 'col-md-6 most-purchased-products',
						'controller' => \App\Http\Controllers\Admin\Charts\MostPurchasedProductsChartController::class,
						'content' => [
							'header' => '10 Productos más vendidos',
						]
					],
				]
			];
	}

@endphp
