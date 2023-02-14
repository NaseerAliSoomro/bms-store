@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
        $domain_name = "/blinkswag-dashboard";
    }
    //echo '<pre>';
    //print_r( $store_user );
    //exit();
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
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/datatables.css')}}" />
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



        <style>
        </style>
    </head>
<body style="overflow-y:hidden ">



		<!--checkout-->
		<div class="checkout_container m-5" style="padding: 10px;background: white;overflow: hidden;">

			<h1>Reset Password</h1>
			<div class="row">
				<div class="col-md-7" id="checkout_delivery_form">
						<!--reset-->
						<form action="" class="log_form reset_form" method="post">
							<div class="imgcontainer">
								<i class="ni ni-single-02 avatar" ></i>
							</div>

							<div class="container">
								<label for="psw"><b>New Password</b></label>
								<input type="password" placeholder="Enter Password" class="password" name="psw" required>
								<label for="re_psw"><b>Re-New Password</b></label>
								<input type="password" placeholder="Enter Re-Password" class="re_password" name="re_psw" required>
								<button type="button" class="resetpassword">Submit</button>
							</div>
						</form>
				</div>

			</div>
		</div>
		<!--checkout end-->

</body>

<script>
    $(document).ready(function(){

        var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $(document).on("click",".resetpassword", function(){
            var password = $(".reset_form").find(".password:first").val();
            var re_password = $(".reset_form").find(".re_password:first").val();
            var store_name = '{{$store_user->store_name}}';
            var user_id = '{{$store_user->id}}';

            if(password == "" || re_password == "")
            {
                alertify.error("Please fill the fields.");
                return false;
            }
            if( password!=re_password)
            {
                alertify.error("Passwords are not match.");
                return false;
            }
            $.ajax({
                type: "POST",
                data: {
                    user_id: user_id,
                    password: password,
                    store_name: store_name,
                    _token: _token,
                },
                url: '{{$domain_name}}/userstore_resetpassword',
                async: false,
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.status=="success")
                    {
                        alertify.success(data.message);
                        window.location = '{{env("APP_URL")}}/store/{{$store_user->store_name}}';
                        return false;
                    }
                }
            });
        });

    });
</script>
	<script src="https://js.stripe.com/v3/"></script>
	<script src="{{env('APP_URL')}}/public/assets/js/checkout_store.js" defer></script>

</html>
