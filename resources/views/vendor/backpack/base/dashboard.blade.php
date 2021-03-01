@extends(backpack_view('blank'))

@php
use App\Models\Product;
use App\Models\Seller;
use App\User;

	$user = backpack_user();
	if ($user->hasRole('Vendedor marketplace')) {
		$seller = Seller::firstWhere('user_id', $user->id);
		$productCount = Product::where('seller_id', $seller->id)->count();
		$selletCount = \App\Models\Seller::count();

		Widget::add()->to('before_content')->type('div')->class('row')->content([
			Widget::make([
				'type' => 'progress',
				'class'=> 'card border-0 text-white bg-dark',
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
				'type' => 'progress',
				'class'=> 'card border-0 text-white bg-dark',
				'progressClass' => 'progress-bar',
				'value' => $productCount,
				'description' => 'Productos.',
				'progress' => (int)$productCount/75*100,
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
					'type'    => 'date-range',
					'wrapper' => ['class' => 'col-sm-12'],
					'content' => 'Rango de fecha GENERAL',
				],
                [
                    'type' => 'card_from_ajax',
                    'name' => 'salesByPeriod',
                    'url' => '/admin/api/invoice/salesbyperiod',
                    //'attribute' => 'count',
					'wrapperClass' => 'col-md-3',
                    'class'=> 'card border-0 text-white bg-dark',
                    'content'=> [
                        'header' => 'Ventas en el periodo',
                        //'body' => 'algo',
                    ],
                ],
                [
                    'name' => 'quotationsByStatus',
                    'type' => 'card_from_ajax',
                    'url' => '/admin/api/quotation/bystatus',
                    //'attribute' => 'count',
					'wrapperClass' => 'col-md-3',
                    'class'=> 'card border-0 text-white bg-dark',
                    'content'=> [
                        'header' => 'Cotizaciones por estado',
                        //'body' => 'algo',
                    ],
                ],
                [
                    'name' => 'generalQuotations',
                    'type' => 'card_from_ajax',
                    'url' => '/admin/api/quotation/generalStatus',
                    //'attribute' => 'count',
					'wrapperClass' => 'col-md-3',
                    'class'=> 'card border-0 text-white bg-dark',
                    'content'=> [
                        'header' => 'Cotizaciones',
                        //'body' => 'algo',
                    ],
                ],
                [
                    'type' => 'chart',
                    'wrapperClass' => 'col-md-6 daily-sales',
                    'controller' => \App\Http\Controllers\Admin\Charts\TopCustomersInPeriodChartController::class,
                    'content' => [
                        'header' => 'Top 10 de Clientes en el periodo',
                    ],
                ],
                [
                    'name' => 'Top 10 productos',
                    'type' => 'table_ajax',
                    'class' => 'col-md-6 table-striped table-hover',
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
                    'class' => 'col-md-6 table-striped table-hover',
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
