<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar asistencia - {{ env('APP_NAME') }}</title>
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
                <span class="title">Registra tu Check in / Check out</span>
            </div>
            <div class="col-lg-12 spacing"></div>
        </div>

        <div class="row px-0 mx-0 content">
            <div class="col-lg-8 col-md-12 inner-content">
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-8">

                        @if (session('error'))
                            <div class="alert alert-warning mx-3" role="alert">
                                {{ session('error') }}
                            </div> 
                        @endif
                        
                        <form action="{{ route('attendance.post', [ 'company' => $company->id ]) }}" method="POST">
                            @csrf
                            <div class="form-group col-md-12">
                                <input 
                                    type="text" 
                                    class="form-control form-control-lg" 
                                    name="rut"
                                    placeholder="Ingresa tu RUT"
                                    id="rut"
                                    required
                                >
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Registrar asistencia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/dist/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Rut Formatter --}}
    <script src="{{ asset('js/rut-formatter.js') }}"></script>
    <script>
        $('#rut').rut();
    </script>
</body>

</html>
