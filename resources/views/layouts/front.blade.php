<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }} ">

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }} ">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@700&family=Roboto&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">

    <style>
        a{
            text-decoration: none !important;
        }
    </style>

</head>

<body>
    @include('layouts.inc.frontnavbar')
    <div class="content">
        @yield('content')
    </div>

    <div class="whatsapp-chat">
        <a href="https://wa.me/+355696656973?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
            <img src="{{ asset('assets/images/Whatsapp-Icon.webp') }}" alt="whatsapp-logo" height="80px" width="80px">
        </a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/checkout.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
          var availableTags = [];
          $.ajax({
            type: "GET",
            url: "/product-list",
            success: function (response) {
                // console.log(response);
                startAutoComplete(response);
            }
          });
          function startAutoComplete(availableTags)
          {
            $( "#search_product" ).autocomplete({
                source: availableTags
            });
          }
        </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('status'))

    <script>
        swal(" {{ session('status') }} ");
    </script>

    @endif
    @yield('scripts')
</body>
</html>
