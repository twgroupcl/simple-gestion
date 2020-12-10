<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
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
            margin-top: 55px;
        }

        @media (max-width: 420px) {
            .title {
            color: white;
            font-size: 25px;
            font-weight: 800;
            display: block;
            }
        }

        @media (min-width: 420px) {
            .title {
            color: white;
            font-size: 35px;
            font-weight: 800;
            display: block;
            }
        }

        .inner-content {
            background-color: white;
            min-height: 300px;
            margin-top: -100px;
        }
        
        .spacing {
            height: 130px;
        }

    </style>
    @stack('styles')
</head>

<body>
    <div class="container-fluid">

        <div class="row header">
            <div class="col-lg-10 text-center title-container">
                @if ($company->logo)
                    <img src="{{ asset($company->logo) }}" alt="" style="max-height: 150px">
                @else 
                    <span class="title">{{ $company->name }}</span>
                @endif
                <span class="title">@yield('header-title')</span>
            </div>
            <div class="col-lg-12 spacing"></div>
        </div>

        @yield('content')
        
    </div>

    <script src="{{ asset('vendor/jquery/dist/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Rut Formatter --}}
    <script src="{{ asset('js/rut-formatter.js') }}"></script>
    <script>
        $('#rut').rut();
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
