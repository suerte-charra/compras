<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('build/assets/app.5380b351.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
    @vite('resources/js/app.js')
    <!-- Scripts -->
    <!--@vite(['resources/sass/app.scss', 'resources/js/app.js'])-->
</head>

<body>
    <div id="app" class="wrapper">
        @include('layouts.menusidebar')
        <div class="container">
            @include('layouts.sidehead')
            <main class="py-4">
                @if (Auth::user()->user_passestatus == 0)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Recuerde cambiar su contraseña</strong>
                        <p>Este mensaje no desaparecera hasta que haya hecho el cambio de contraseña</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (
                    (Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'cap' || Auth::user()->categoria == 'compras') &&
                        (Route::currentRouteName() != 'home' && Route::currentRouteName() != 'indicemov'))
                    <div>
                        <strong class="m-4">Los campos con <b class="text-danger">*</b> son obligatorios</strong>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @yield('js')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('build/assets/app.024077bb.js') }}"></script>
</body>

</html>
