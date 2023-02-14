<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="overflow-x: hidden;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BLINKSWAG - Dropshipping Swag & Warehousing Services
    </title>
    <!-- Favicon -->

    {{-- Start Naseer --}}
    {{-- <link href="{{ ('public/argon/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ ('public/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ ('argon/img/brand/favicon.png') }}" rel="icon" type="image/png">
    <link rel="stylesheet" href="{{ asset('public/assets/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('public/assets/css/datatables.css')}}" /> --}}
    {{-- End Naseer --}}

    <link href="https://dashboard.blinkswag.com/public/argon/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- Icons -->
    <link href="https://dashboard.blinkswag.com/public/argon/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="https://dashboard.blinkswag.com/public/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://dashboard.blinkswag.com/public/assets/css/alertify.css">
    <link rel="stylesheet" href="https://dashboard.blinkswag.com/public/assets/css/semantic.css">
    <!-- Argon CSS -->
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jqc-1.12.4/dt-1.11.2/r-2.2.9/datatables.min.css" /> -->

        {{-- naseer --}}
        <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables.css')}}" />
        {{-- <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/css/datatables.css" /> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script src="https://dashboard.blinkswag.com/public/assets/vendor/jquery/dist/jquery.min.js"></script> -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- <script type="text/javascript"
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
        {{-- naseer --}}
        <script type="text/javascript" src="{{('public/assets/js/datatables.js')}}"></script>
    {{-- <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/datatables.js"></script> --}}

    @if(Route::getFacadeRoot()->current()->uri() == 'editstore/{id}' )
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" integrity="sha512-zKvhCkM8b3JMULax/MlTkNk4gQwMbY8CqpDQC74/n7H6UK3HOZA/mO/fvjhVlh0V/E6PCrp4U6Lw6pnueS9HCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @else

    @endif
    {{-- naseer --}}
    <link type="text/css" href="{{ asset('public/argon/css/argon.css?v=1.0.0') }}" rel="stylesheet">
    {{-- <link type="text/css" href="{{env('APP_URL')}}/public/argon/css/argon.css?v=1.0.0" rel="stylesheet"> --}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

    <style>
        * {
            font-family: sans-serif;
        }
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: #e7f3f8;
            border-radius: 200px;
        }

        ::-webkit-scrollbar-thumb {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 200px;
        }
        .navbar
        {
            transition: width 0.5s;
        }
        .main-content
        {
            transition: width 0.7s;
        }
        .navbar.shrink
        {
            width: 65px;
        }
        .main-content.shrink
        {
            margin-left: 65px !important;
        }

        .loader{
            position: absolute;
            animation: none;
            top: 50%;
            left: 44%;
            border: none;
        }
    </style>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "dxdiphkq15");
    </script>

</head>

<body class="{{ $class ?? '' }}" style="overflow-x: hidden;overflow-y: hidden;background-color:#fff">

    <div class="loader" style="z-index: 1; display:none;position: fixed;">
        {{-- naseer --}}
        <img src="{{('public/assets/img/blinkswag_loader.gif')}}" style="width: 200px;">
        {{-- <img src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" style="width: 200px;"> --}}
    </div>

    @auth()
        @if(Route::current()->getName() !== 'sharereview' )
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('store::layouts.navbars.sidebar')
        @endif
    @endauth

    <div class="main-content">
        <!-- @ if(Route::current()->getName() !== 'sharereview')
            @ include('layouts.navbars.navbar')
        @ endif -->

        @yield('content')
    </div>

    @guest()
        @include('store::layouts.footers.guest')
    @endguest

    @auth()
        @if(Route::current()->getName() !== 'sharereview' )
        @include('store::layouts.navbars.navs.footer')
        @endif
    @endauth

    <script src="https://dashboard.blinkswag.com/public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>


    @stack('js')

    <!-- Argon JS -->

    {{-- Naseer Start --}}
    {{-- <script src="{{ asset('public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 'vendor/store') }}">
    </script>
    <script src="{{ asset('public/assets/js/argon.js?v=1.0.0', 'vendor/store') }}"></script>
    <script src="{{ asset('public/assets/js/alertify.js', 'vendor/store') }}"></script> --}}
    {{-- Naseer End --}}
    <script src="https://dashboard.blinkswag.com/public/assets/js/argon.js?v=1.0.0"></script>
    <script src="https://dashboard.blinkswag.com/public/assets/js/alertify.js"></script>
    <script type="text/javascript" id="zsiqchat">
        var $zoho = $zoho || {};
        $zoho.salesiq = $zoho.salesiq || {
            widgetcode: "675b2343f6e43695e5fff9335425202a656d43f0d72eccefbd23d81b71ff5f9981782146f4f0cd332a06213b83e6e85e",
            values: {},
            ready: function() {}
        };
        var d = document;
        s = d.createElement("script");
        s.type = "text/javascript";
        s.id = "zsiqscript";
        s.defer = true;
        s.src = "https://salesiq.zoho.com/widget";
        t = d.getElementsByTagName("script")[0];
        t.parentNode.insertBefore(s, t);

    </script>
</body>
@auth
    <script>
        $("#loginform").submit(function(eventObj) {
            $("<input />").attr("type", "hidden")
                .attr("name", "email")
                .attr("value", "{{ auth()->user()->email }}")
                .appendTo("#loginform");
            $("<input />").attr("type", "hidden")
                .attr("name", "validatetoken")
                .attr("value", "8ab576fc17374751ad3cb7018f1672f3")
                .appendTo("#loginform");
            return true;
        });
        $("#loginform2").submit(function(eventObj) {
            $("<input />").attr("type", "hidden")
                .attr("name", "email")
                .attr("value", "{{ auth()->user()->email }}")
                .appendTo("#loginform2");
            $("<input />").attr("type", "hidden")
                .attr("name", "validatetoken")
                .attr("value", "8ab576fc17374751ad3cb7018f1672f3")
                .appendTo("#loginform2");
            return true;
        });

    </script>
@endauth

</html>
