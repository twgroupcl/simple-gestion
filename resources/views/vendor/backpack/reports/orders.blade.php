

@php
$total = $data['orders']['total'];
$pending = $data['orders']['pending'];
$complete = $data['orders']['complete'];
$paid = $data['orders']['paid'];


Widget::add()->to('after_content')->type('div')->class('row')->content([
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets 
            [ 'type' => 'simple-text', 'content' => '<h3>Ordenes</h3>'],
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
            'header' => 'Total de ordenes', // optional
            'body'   => '<h3>' . $total . '</h3>',
        ]
    ]),

    Widget::add([
        'name'        => 'approved',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-success mb-2',
        'value'       =>  $paid,
        'description' => 'Ordenes pagadas.',
        'progress'    =>   $paid * 100 / $total   , // integer
        'hint'        => 'Total de ordenes: ' . $total,
    ]),

    Widget::add([
        'name'        => 'rejected',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-warning mb-2',
        'value'       => $pending,
        'description' => 'Ordenes pendientes.',
        'progress'    => $pending * 100 / $total   , // integer
        'hint'        => 'Total de ordenes: ' . $total,
    ]),

    Widget::add([
        'name'        => 'pending',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-info mb-2',
        'value'       => $complete,
        'description' => 'Ordenes completadas.',
        'progress'    => ($complete) * 100 / $total   , // integer
        'hint'        => 'Total de ordenes: ' . $total,
    ]),

 
]);
@endphp