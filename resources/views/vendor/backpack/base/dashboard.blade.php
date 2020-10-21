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

@endphp
