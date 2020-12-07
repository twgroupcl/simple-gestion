<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia registrada - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" media="screen" href="{{ asset('css/theme.css') }}">
    <style>
        body {
            background-color: #fbf9f4;
        }

        .header {
            background-color: #fd6060;
            /* height: 300px; */
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
            display: block;
        }

        @media (max-width: 420px) {
            .title {
            color: white;
            font-size: 25px;
            font-weight: 800;
            display: block;
            }
        }

        @media (min-width: 421px) {
            .title {
            color: white;
            font-size: 35px;
            font-weight: 800;
            display: block;
            }
        }

        .inner-content {
            background-color: white;
            height: 300px;
            margin-top: -100px;
        }

        .spacing {
            height: 130px;
        }

    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="row header">
            <div class="col-lg-10 text-center title-container">
                @if ($company->logo)
                    <img src="{{ $company->logo }}" alt="" style="max-height: 70px">
                @else 
                    <span class="title">{{ $company->name }}</span>
                @endif
                <span class="title">
                    @if ($attendance->entry_type === $typeCheckIn)
                        ¡Check In registrado!
                    @endif
                    @if ($attendance->entry_type === $typeCheckOut)
                        ¡Check Out registrado!
                    @endif
                </span>
            </div>
            <div class="col-lg-12 spacing"></div>
        </div>

        <div class="row px-0 mx-0 content">
            <div class="col-lg-8 col-md-12 inner-content">
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Cliente</b>: {{ $attendance->customer->first_name  . ' ' . $attendance->customer->last_name }}</li>
                            <li class="list-group-item"><b>Hora marcada</b>: {{ $attendance->attendance_time->format('h:i A') }}</li>
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
