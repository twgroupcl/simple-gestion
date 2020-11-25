<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo</title>
    <link rel="stylesheet" media="screen" href="{{ asset('css/theme.css') }}">
    <style>
        body {
            background-color: #fbf9f4;
        }

        .header {
            background-color: #fd6060;
            height: 300px;
            justify-content: center;
        }

        .content {
            justify-content: center;
        }

        .title-container {
            margin-top: 95px;
        }

        .title {
            color: white;
            font-size: 35px;
            font-weight: 800;
        }

        @media (max-width: 400px) {
            .title {
            color: white;
            font-size: 25px;
            font-weight: 800;
            }
        }

        @media (min-width: 401px) {
            .title {
            color: white;
            font-size: 35px;
            font-weight: 800;
            }
        }

        .inner-content {
            background-color: white;
            height: 300px;
            margin-top: -100px;
        }

    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="row header">
            <div class="col-lg-10 text-center title-container">
                <span class="title">
                    @if ($attendance->entry_type === $typeCheckIn)
                        Check IN registrado con exito!
                    @endif
                    @if ($attendance->entry_type === $typeCheckOut)
                        Check OUT registrado con exito!
                    @endif
                </span>
            </div>
        </div>

        <div class="row px-0 mx-0 content">
            <div class="col-lg-8 col-md-12 inner-content">
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Cliente</b>: {{ $attendance->customer->first_name  . ' ' . $attendance->customer->las_tname }}</li>
                            <li class="list-group-item"><b>Hora marcada</b>: {{ $attendance->attendance_time->format('H:i A') }}</li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/dist/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
