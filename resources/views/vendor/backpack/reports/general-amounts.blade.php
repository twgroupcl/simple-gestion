

@php
$total = $data['sellers']['total'];
$rejected = $data['sellers']['rejected'];
$approved = $data['sellers']['approved'];


Widget::add()->to('after_content')->type('div')->class('row')->content([
    Widget::add([
        'type' => 'div',
        'class'   => 'row ',
        'content' => [ // widgets 
            [ 'type' => 'simple-text', 'content' => '<h3>Generales</h3>'],
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
            'header' => 'Total en ventas', // optional
            'body'   => '<h3> $' . $data['orders']['amount_total'] . '</h3>',
        ]
    ]),

]);
@endphp