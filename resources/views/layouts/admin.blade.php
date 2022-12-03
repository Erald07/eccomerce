<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/css/material-dashboard.css') }} ">

</head>

<body class="g-sidenav-show   bg-gray-100">

    @include('layouts.inc.sidebar')

    <main class="main-content position-relative border-radius-lg ">

        @include('layouts.inc.adminnav')

        <div class="container-fluid py-4">

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.inc.adminfooter')

        </div>
    </main>
    <!-- Scripts -->
    <!-- <script src="{{ asset('admin/js/argon-dashboard.min.js') }}" defer></script> -->
    <script src="{{ asset('admin/js/popper.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/smooth-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/chartjs.min.js') }}" defer></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('status'))

    <script>
        swal(" {{ session('status') }} ");
    </script>

    @endif
    @yield('scripts')
</body>
</html>
