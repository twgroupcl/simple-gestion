@extends(backpack_view('blank'))

@php
	$productCount = \App\Models\Product::count();
	$selletCount = \App\Models\Seller::count();
	$userCount = \App\User::count();

	Widget::add()->to('before_content')->type('div')->class('row')->content([
		// notice we use Widget::make() to add widgets as content (not in a group)
		Widget::make([
			'type' => 'progress',
			'class' => 'card border-0 text-white bg-primary',
			'progressClass' => 'progress-bar',
			'value' => $userCount,
			'description' => 'Usuarios.',
			'progress' => 100*(int)$userCount/1000,
		]),

		Widget::make([
			'type' => 'progress',
			'class'=> 'card border-0 text-white bg-dark',
			'progressClass' => 'progress-bar',
			'value' => $productCount,
			'description' => 'Productos.',
			'progress' => (int)$productCount/75*100,
		]),

		Widget::make([
			'type' => 'progress',
			'class'=> 'card border-0 text-white bg-success',
			'progressClass' => 'progress-bar',
			'value' => $selletCount,
			'description' => 'Negocios.',
			'progress' => (int)$selletCount/75*100,
		]),
	]);

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
	    	// [
		    //     'type' => 'chart',
		    //     'wrapperClass' => 'col-md-6 most-purchased-product-categories',
		    //     'controller' => \App\Http\Controllers\Admin\Charts\MostPurchasedProductCategoriesChartController::class,
			// 	'content' => [
			// 	    'header' => '10 Categorías más compradas',
		    // 	]
			// ],
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

@endphp
