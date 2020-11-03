

@php
$total = $data['products']['total'];
$rejected = $data['products']['rejected'];
$approved = $data['products']['approved'];


Widget::add()->to('after_content')->type('div')->class('row')->content([
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets 
            [ 'type' => 'simple-text', 'content' => '<h3>Productos</h3>'],
        ]
    ]),

    //break
    Widget::add([
        'type' => 'div',
        'class'   => 'w-100 d-none d-md-block',
    ]),


    Widget::add([
        'type'       => 'card',
        'wrapper' => ['class' => 'col-sm-2 col-md-2 '], // optional
        'class'   => 'card bg-secondary text-info text-center', // optional
        'content' => [
            'header' => 'Total de productos', // optional
            'body'   => '<h3>' . $total . '</h3>',
        ]
    ]),

    Widget::add([
        'name'        => 'approved',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-success mb-2',
        'value'       =>  $approved,
        'description' => 'Productos aprobados.',
        'progress'    =>   $approved * 100 / $total   , // integer
        'hint'        => 'Total de productos: ' . $total,
    ]),

    Widget::add([
        'name'        => 'rejected',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-warning mb-2',
        'value'       => $rejected,
        'description' => 'Productos rechazados.',
        'progress'    => $rejected * 100 / $total   , // integer
        'hint'        => 'Total de productos: ' . $total,
    ]),

    Widget::add([
        'name'        => 'pending',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-info mb-2',
        'value'       => $total - $rejected - $approved,
        'description' => 'Productos pendientes.',
        'progress'    => ($total - $rejected - $approved) * 100 / $total   , // integer
        'hint'        => 'Total de productos: ' . $total,
    ]),

    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets 
            [ 'type' => 'simple-text', 'content' => '<h3>Top 10 Productos</h3>'],
        ]
    ]),

    //break
    Widget::add([
        'type' => 'div',
        'class'   => 'w-100 d-none d-md-block',
    ]),
    
    Widget::add([
        'name'        => 'top10',    
        'type'        => 'top',
        //'class'       => 'card text-white bg-info mb-2',
        'columns'     => [
            'name' => 'Nombre',
            'sku' => 'SKU',
            'price' => 'Precio',
            'seller' => [
                'attribute' => 'name',
                'column' => 'Tienda'
            ]
        ],
        'collection'  => $data['products']['top_10']
    ]),
]);

@endphp