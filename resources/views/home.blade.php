<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" media="screen" href="{{ asset('css/theme.css') }}">


        <title>Filsa Virtual</title>
        <style>
            body,
            html {
            height: 100%;
            margin: 0;
            font: 400 15px/1.8 "Lato", sans-serif;
            color: #777;
            }
            .bgimg-1,
            .bgimg-2,
            .bgimg-3 {
                position: relative;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .bgimg-1 {
                background-image: url('img/filsa/cortina-web.jpg');
                height: 100%;

            }
            .bgimg-2 {
                background-image: url('img/filsa/cortina-mobile.jpg');
                height: 100%;
            }
        </style>

    </head>
    <body>
        <div class="d-none d-lg-block d-md-block d-sm-block bgimg-1">
        </div>
        <div class="d-block d-sm-none bgimg-2">
        </div>
    </body>
</html>