@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
        $domain_name = "/blinkswag-dashboard";
    }
@endphp

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
    {{-- naseer --}}
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables.css')}}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/css/datatables.css" /> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/datatables.js"></script>

    <link type="text/css" href="{{env('APP_URL')}}/public/argon/css/argon.css?v=1.0.0" rel="stylesheet">

    <script src="https://dashboard.blinkswag.com/public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://dashboard.blinkswag.com/public/assets/js/argon.js?v=1.0.0"></script>
    <script src="https://dashboard.blinkswag.com/public/assets/js/alertify.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" integrity="sha512-zKvhCkM8b3JMULax/MlTkNk4gQwMbY8CqpDQC74/n7H6UK3HOZA/mO/fvjhVlh0V/E6PCrp4U6Lw6pnueS9HCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body style="overflow-y:hidden ">
    </body>

    </html>
<?php

if($status == "success")
{
    //echo 'Thanks Salesorder has been placed.';
    ?>
    <script>
        Swal.fire({
            title: '<strong class="proof_popup_title">Your order has been placed!</strong>',
            icon: 'success',
            html: '<p style="text-align: center;"> Thank you for your purchase! Now we are preparing for the shipment. If you would like to cancel this order, please let us know within 24 hours. </p>',
            confirmButtonText: 'Okay',
            allowOutsideClick: false,
            showCloseButton: false,
            allowOutsideClick: false,
            }).then((result) => {
            if (result.isConfirmed) {
                location.href = "{{env('APP_URL')}}/store/{{$store_name}}"
            }
        })
    </script>
    <?php
}else if($status =='already submited'){
    ?>
    <script>
        Swal.fire({
            title: '<strong class="proof_popup_title">Your order has been Already placed!</strong>',
            icon: 'warning',
            html: '<p style="text-align: center;"> Please wait till we are preparing for the shipment. If you would like to cancel this order, please let us know within 24 hours. </p>',
            confirmButtonText: 'Okay',
            allowOutsideClick: false,
            showCloseButton: false,
            allowOutsideClick: false,
            }).then((result) => {
            if (result.isConfirmed) {
                location.href = "{{env('APP_URL')}}/store/{{$store_name}}"
            }
        })
    </script>
    <?php
}else{
    echo 'Something went wrong :(';
}
?>
