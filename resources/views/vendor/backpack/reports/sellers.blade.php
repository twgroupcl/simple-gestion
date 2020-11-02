

@php
$total = $data['sellers']['total'];
$rejected = $data['sellers']['rejected'];
$approved = $data['sellers']['approved'];


Widget::add()->to('after_content')->type('div')->class('row')->content([
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets 
            [ 'type' => 'simple-text', 'content' => '<h3>Vendedores</h3>'],
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
            'header' => 'Total de vendedores', // optional
            'body'   => '<h3>' . $data['sellers']['total'] . '</h3>',
        ]
    ]),

    Widget::add([
        'name'        => 'approved',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-success mb-2',
        'value'       =>  $approved,
        'description' => 'Vendedores aprobados.',
        'progress'    =>   $approved * 100 / $total   , // integer
        'hint'        => 'Total de vendedores: ' . $total,
    ]),

    Widget::add([
        'name'        => 'rejected',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-warning mb-2',
        'value'       => $rejected,
        'description' => 'Vendedores rechazados.',
        'progress'    => $rejected * 100 / $total   , // integer
        'hint'        => 'Total de vendedores: ' . $total,
    ]),

    Widget::add([
        'name'        => 'pending',    
        'type'        => 'progress',
        'class'       => 'card text-white bg-info mb-2',
        'value'       => $total - $rejected - $approved,
        'description' => 'Vendedores pendientes.',
        'progress'    => ($total - $rejected - $approved) * 100 / $total   , // integer
        'hint'        => 'Total de vendedores: ' . $total,
    ]),
]);
@endphp