@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard
        $domain_name = "/blinkswag-dashboard";

    }

    $limit = 100;
    $email= 'swt.waqas@gmail.com';
    $consumed = 0;

	$cartdisplay = "display: none;";
	$interface = "display: block;";

	$googleuserid = 0;

	if( isset($googleuser) )
	{
		$cartdisplay = "display: block;";
		$interface = "display: none;";
	}

	if(\Session::get("googleuser1"))
	{
		$googleuser =  \Session::get("googleuser1");
		$cartdisplay = "display: block;";
		$interface = "display: none;";
	}


    //dd( $googleuser );

    $items = array();
    $item_groups = array();
    $all_selected_items = [];
    $item_json_fields = [];

    if(!empty($store))
    {
        $all_selected_items = json_decode( $store->all_items_json, true);

		if($all_selected_items!=null)
		{
			foreach($all_selected_items as $key => $product)
			{
				if (array_key_exists("group_id",$product))
				{
					array_push( $item_groups, $product);
				}else{
					array_push( $items, $product);
				}
			}
		}

    }

    if(!empty($store->complete_settings))
    {
        $complete_settings = json_decode( $store->complete_settings, true);
        $item_json_fields =  $complete_settings['item_json_fields'];
    }else{
		$complete_settings = [];
		$item_json_fields = [];
	}

    function hexToRgb($hex) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));

        return $rgb['r']." ".$rgb['g']." ".$rgb['b'];
    }

	//dd( $my_editing  );
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
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables.css')}}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/public/assets/css/datatables.css" />

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
		.main-item {
		padding: 10px;
		background-color: #fff;
		width: 700px;
		}

		.background-masker {
		background-color: #fff;
		position: absolute;
		}

		.btn-divide-left {
		top: 0;
		left: 50%;
		height: 100%;
		width: 5%;
		}

.animated-background {
  animation-duration: 2s;
  animation-fill-mode: forwards;
  animation-iteration-count: infinite;
  animation-name: placeHolderShimmer;
  animation-timing-function: linear;
  background-color: #f6f7f8;
  background: linear-gradient(to right, #eeeeee 8%, #bbbbbb 18%, #eeeeee 33%);
  background-size: 800px 104px;
  height: 70px;
  position: relative;
}
@keyframes placeHolderShimmer {
  0% {
    background-position: -800px 0
  }
  100% {
    background-position: 800px 0
  }
}

        h1{
            color: #525f7f;
        }
        h3{
            color:white;
        }

        .carousel-item {
        height: 32rem;
        }
        .carousel-caption
        {
            background-color: rgb(0 0 0 / 79%);
            color: white;
            padding-left: 20px;
            padding-right: 20px;
        }
        .carousel-item > img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: auto;
        }

        .footer-basic {
            padding:40px 0;
            background-color:#ffffff;
            color:#4b4c4d;
            border-top: 2px solid #CCC;
        }
        .footer-basic ul {
        padding:0;
        list-style:none;
        text-align:center;
        font-size:18px;
        line-height:1.6;
        margin-bottom:0;
        }

        .footer-basic li {
        padding:0 10px;
        }

        .footer-basic ul a {
        color:inherit;
        text-decoration:none;
        opacity:0.8;
        }

        .footer-basic ul a:hover {
        opacity:1;
        }

        .footer-basic .social {
        text-align:center;
        padding-bottom:25px;
        }

        .footer-basic .social > a {
        font-size:24px;
        width:40px;
        height:40px;
        line-height:40px;
        display:inline-block;
        text-align:center;
        border-radius:50%;
        margin:0 8px;
        color:inherit;
        opacity:0.75;
        }

        .footer-basic .social > a:hover {
        opacity:1;
        }

        .footer-basic .copyright {
        margin-top:15px;
        text-align:center;
        font-size:13px;
        color:#aaa;
        margin-bottom:0;
        }
        .banner{
            position:relative;
        }
        .banner_bg_color_view
        {
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            position: absolute;
            z-index: -2;
            background-color: #CCC;
        }
        .overlay {
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            position: absolute;
            z-index: -1;
            background-image: url(https://blinkswag.com/img/cms/1000_F_229391806_oaIIprMsAZjlQ8OgsIA8mxkxdhUFY7nD.jpg);
            background-size: contain;
            opacity: .11;
            transition: background 0.3s,border-radius 0.3s,opacity 0.3s;
        }

        .products_container_selected h3
        {
            color: #525f7f;
        }

        .get_details_id
        {
            text-align: left;
        }

        body{
            font-family: sans-serif;
        }

        .card{
            box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 1px rgb(0 0 0 / 14%), 0px 1px 3px 0px rgb(0 0 0 / 12%);
            padding: 5px 20px;
            border-radius: 20px !important;
            margin-bottom: 24px;
        }

        .eye_icon
        {
            cursor:pointer;
            width: 30px;
            right: 20px;
            position: absolute;
        }

        .card-body {
            padding-right: 25px;
            padding-left: 5px;
            padding-top: 0px;
            text-align:left;
        }

        .loader{
                    position: absolute;
                    animation: none;
                    top: 50%;
                    left: 44%;
                    border: none;
					border-radius: inherit;

                }
        .card-img-top123 {
            width: 100%;
            border-top-left-radius: calc(0.375rem - 1px);
            border-top-right-radius: calc(0.375rem - 1px);
        }

        .modal-dialog.demand_items {
            max-width: 60%;
        }
        .product-add-to-cart.label-full-width label {
            width: 100%;
        }
        .product-add-to-cart.label-full-width select {
            width: 100% !important;
            margin-bottom: 5px;
        }

        .v-badge, .v-badge__badge {
            display: inline-block;
            line-height: 1;
        }
        .v-badge__badge {
            border-radius: 10px;
            color: #fff;
            font-size: 12px;
            height: 20px;
            letter-spacing: 0;
            min-width: 20px;
            padding: 4px 6px;
            pointer-events: auto;
            position: absolute;
            text-align: center;
            text-indent: 0;
            top: -12px;
            transition: .3s cubic-bezier(.25,.8,.5,1);
            white-space: nowrap;
            right:-15px;
        }

		.backtoshopping,
		.backtocart
		{
			cursor:pointer;
			font-weight:700;
		}

        .cart_header
        {
            cursor:pointer;
        }
        .cart_container{
            z-index: 9999;
        }

		.checkout_container p {
			font-size: 12px;
		}
		.checkout_container span {
			font-size: 14px;
		}

		/* Bordered form */
form.log_form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
.log_form input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
.log_form button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
.log_form button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.log_form .cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.log_form .imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
.log_form i.avatar {
  /* width: 40%;
  border-radius: 50%; */
}

/* Add padding to containers */
.log_form .container {
  /* padding: 16px; */
}

/* The "Forgot password" text */
.log_form span.psw {
  float: right;
  /* padding-top: 16px; */
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  .log_form span.psw {
    display: block;
    float: none;
  }
  .log_form .cancelbtn {
    width: 100%;
  }
}

#form_container
{
    border: 1px solid #CCC;
    padding: 30px;
    border-radius: 5px;
}

.logoutlabel
{
	color:blue;
	cursor:pointer;
}

ul.nav.nav-tabs li {
    width: 100%;
}

.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #172b4d !important;
    border: none;
    font-weight: 800;
    background-color: #e9ecef96;
    border-left: 4px solid #172b4d;
    height: auto;
    transition: .3s;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
	text-align:left;
}


h2.cat-heading {
    margin: 12px;
    font-size: 14px;
    margin-top: 36px;
    line-height: normal;
    margin-left: 24px;
	text-align:left;
}

ul.nav.nav-tabs li a {
    font-size: 12px;
    line-height: normal;
    color: rgb(15, 36, 64);
    font-weight: 400;
    border-radius: 0px;
    border:none;
}

ul.nav.nav-tabs li {
    padding-top: 8px;
    padding-bottom: 8px;
    padding-left: 10px;
}

ul.nav.nav-tabs.categories li a {
    float: left;
    line-height: 20px;
}

ul.nav.nav-tabs.categories {
    overflow: auto;
    overflow-x: auto;
    overflow-y: auto;
    height: 500px;
    background:#fff;
    place-content: start;
}

.content_heading {
    margin-top: 35px;
}

.content_heading h2 {
    color: #131415;
    font-size: 32px;
    /* font-family: Gilroy; */
    font-weight: 600;
    margin-bottom: 18px;
}

.content_heading p {
    font-size: 13px;
    width: 100%;
    font-style: italic;
    text-align: justify;
}

.content_heading h3 {
    color: #131415;
    display: inline-block;
    font-size: 21px;
    min-height: 31px;
    line-height: 1.6;
    margin-bottom: 24px;
    font-weight: 700;
}

.content-box {
    box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%),
    0px 1px 1px 1px rgb(0 0 0 / 14%), 0px 1px 3px 0px rgb(0 0 0 / 12%);
    padding: 5px 20px;
    border-radius: 20px;
    margin-bottom: 24px;
}

.item-title p {
    color: #0F2440;
    height: 28px;
    margin: 0;
    overflow: hidden;
    font-size: 12px;
    font-weight: 500;
    line-height: 15px;
}

.item-price p strong {
    font-weight: 800;;
}
.item-price p {
    color: #0F2440;
    opacity: 0.6;
    font-size: 12px;
    margin-top: 3px;
    line-height: normal;
}

.col-md-2.fixed-content {
    /* position: fixed; */
}

.ml-220 {
    margin-left: 220px;
}

.project-append{
    margin-left: 220px;
}

.item-image img {
    height: 230px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

.item-button {
    float: left;
}

.item-title{
    width: 80%;
    float: left;
}

.item-price {
    z-index: 9999;
    clear: both;
}

/* The side navigation menu */
.sidenav {
  height: 80%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 130px; /* Stay at the top */
  right: 0;
  background-color: #fff; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 12px;
  padding-bottom: 12px; /* Place content 60px from the top */
  transition: 0.5s;
  border: 1px solid #ccc; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */


/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}



h2.cart-title {
    font-size: 14px;
    line-height: normal;
    margin-left: 12px;
    margin-right: 12px;
    margin-bottom: 12px;
    color: #1B1C1F;

}
hr {
    border: none;
    height: 1px;
    margin: 0;
    flex-shrink: 0;
    background-color: rgba(0, 0, 0, 0.12);
    min-height: 4px;
}

ul.cart-products {
    list-style: none;
    margin: 0;
    padding: 0;
}


ul.cart-products li a {
    padding-top: 6px;
    padding-left: 12px;
    padding-bottom: 6px;
    display: flex;
    position: relative;
    box-sizing: border-box;
    text-align: left;
    align-items: center;
    padding-top: 8px;
    padding-bottom: 8px;
    justify-content: flex-start;
    text-decoration: none;
}
ul.cart-products li a .img-box {
    width: 55px;
    border: 1px solid #D3DBE6;
    height: 55px;
    padding: 6px;
    margin-right: 10px;
}

ul.cart-products li a .img-box img {
    color: transparent;

    object-fit: cover;
    text-align: center;
    text-indent: 10000px;
    object-fit: contain;
}

.content-text {
    min-width: 0;
}
.content-text h3 {
    color: #0B1829;
    overflow: hidden;
    font-size: 14px;
    /* font-family: Gilroy-SemiBold; */
    line-height: normal;
    white-space: nowrap;
    text-overflow: ellipsis;
    margin-bottom: 0;
    width: 150px;
}
.content-text p {
    color: #787B80;
    font-size: 11px;
    padding: 0;
    margin: 0;
}

.content-text p strong {
    font-weight: 600;
}

.del-icon {
    position: relative;
    top: 21px;
    right: -12px;

    overflow: hidden;
    float: left;
    font-size: 14px;
}

ul.cart-products .qty {

    gap: 6px;
    width: 100%;
    display: flex;
    padding-left: 12px;
    padding-right: 12px;

}
p.f-400 {
    font-size: 14px;
    font-weight: 400;
    color: #131415;
    margin: 0;
}

p.f-300 {
    font-size: 14px;
    font-weight: 300;
    margin: 0;
}

ul.cart-products {
    height: 310px;
    overflow: auto;
}

.total {
    margin: 12px;
    display: flex;
    margin-top: 10px;
}
p.total-estimate {
    color: #0B1829;
    font-weight: 500;
    font-size: 16px;
    font-weight: 700;
    line-height: 32px;
    letter-spacing: 0.00938em;

}
p.total-num {
    color: #0B1829;
    font-weight: 700;
    margin-left: auto;
    font-size: 16px;
    line-height: 32px;
}
svg.MuiSvgIcon-root.jss60 {
    width: 14px;
    color: #ccc !important;
}

.estimate-btn {
    display: flex;
    margin-left: 12px;
    margin-right: 12px;
}

.estimate-btn button {
    font-size: 15px;
    margin-top: auto;
    min-height: 64px;
    width: 100%;
    color: #FFFFFF;
    box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%), 0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%);
    background-color: #172b4d;
    border-radius: 32px;
}

hr.divider{
    min-height: 1px;
}

.col-md-7.ml-220 {
    max-width: 71% !important;
    width: 62%;
    flex: inherit;
}

.estimate_form .form-control {
    padding: 25px 30px;
    background: #FFFFFF;
    border-radius: 32px;
}

.estimate_form p {
    margin-bottom: 5px;
}

.estimate_form input {
    margin-bottom: 20px;
}

.upload_content .icon {
    float: left;
    margin-left: 20px;
}

.upload_content {
    margin-top: 25px;
}

.upload_content p {
    font-weight: 500;
    margin-bottom:0px;
}


.upload_content span {
    margin-bottom: 0;
    font-size:13px;
}

/* file uploader css*/

.uploder_container {
  padding: 50px 10%;
  width: 100%;
}

.box {
  position: relative;
  width: 100%;
}

.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
  border-bottom: 1px solid #f4f4f4;
  margin-bottom: 10px;
}

.box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}

.dropzone-wrapper {
  border: 2px dotted #ccc;
  border-radius:25px;
  color: #92b0b3;
  position: relative;
  height: 180px;
  margin-top:15px;
}

.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center !important;
  width: 100%;
  top: 50px;
  font-size: 16px;
}

.dropzone,
.dropzone:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
  top:0px;
}

.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
  background: #ecf0f5;
}

.preview-zone {
  text-align: center;
}

.preview-zone .box {
  box-shadow: none;
  border-radius: 0;
  margin-bottom: 0;
}

.dropzone-desc p {
    width: 100%;
}

.card-header{
    padding: 0 1.5rem !important
    ;
}
.card-body{
    padding: 0 1.5rem !important;
}
.card {
    border: none;
}

ol.breadcrumb {
    background: #fff;
    margin-top: 10px;
}
ol.breadcrumb li {
    font-size: 14px;
}

li#custom-swag a {
    color: #989EA4;
}

li.breadcrumb-item.active {
    color: #000;
}

.item-button img {
    width: 30px;
}


/* Loader */
#overlay {
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;

  background-color: rgb(255 255 255 / 75%);
}

.spinner1 {
    margin: 0 auto;
    height: 250px;
    width: 250px;
    margin-top: 10%;
}

/* modal box css */

.modal-content{
    height:550px;
    overflow:auto;
    border-radius: 20px;

}

::-webkit-scrollbar-track{
    background: none !important;
}

.modal-content::-webkit-scrollbar-track-piece:end {
    background: transparent;
    margin-bottom: 10px;
    border-radius: 20px;
}

.modal-content::-webkit-scrollbar-track-piece:start {
    background: transparent;
    margin-top: 10px;
    border-radius: 20px;
}

.model-color-grey{
color: #787B80;
    font-size: 16px;
    margin-top: 4px;
    font-weight: 400;
}



ul#color li {
    float: left;
    margin-right: 10px;
}


/* input[type='radio']{
    box-sizing: border-box;
    padding: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    top: 13.33333px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 20px;
    width: 20px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;

    outline: none;
    position: relative;
    z-index: 1000;
    border-radius: 50%;
}

input[type='radio']:checked:after {
    display: block;
    width: 15px;
    height: 15px;
    border-radius: 15px;
    top: 0px;
    left: 2px;
    position: relative;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid #fff;
    margin: 0 auto;
} */
input[type='radio'].blue,input[type='radio'].Blue{
    background: #0000FF;
}

input[type='radio'].Black,input[type='radio'].black{
    background: #000000;
}

input[type='radio'].White,input[type='radio'].white{
    background: #e3e1d7;
}

input[type='radio'].Navy,input[type='radio'].navy{
    background: #000080;
}

input[type='radio'].Grey,input[type='radio'].grey,input[type='radio'].Charcoal{
    background: #808080;
}

input[type='radio'].Light.Grey,input[type='radio'].light.grey{
    background: #D3D3D3;
}


input[type='radio'].Royal,input[type='radio'].royal{
    background: #4169E1;
}


input[type='radio'].Camel,input[type='radio'].camel{
    background: #D2B48C;
}

input[type='radio'].Natural,input[type='radio'].natural{
    background: #FAEBD7;
}

input[type='radio'].Brown,input[type='radio'].brown{
    background: #A52A2A;
}

input[type='radio'].Maroon,input[type='radio'].maroon{
    background: #800000;
}
input[type='radio'].DarkRed,input[type='radio'].darkred{
    background: #8B0000;
}
input[type='radio'].Red,input[type='radio'].red{
    background: #FF0000;
}
input[type='radio'].Salmon,input[type='radio'].salmon{
    background: #FA8072;
}
input[type='radio'].Coral,input[type='radio'].coral{
    background: #FF7F50;
}
input[type='radio'].Orange,input[type='radio'].orange{
    background: #FFA500;
}
input[type='radio'].Gold,input[type='radio'].gold{
    background: #FFD700;
}
input[type='radio'].Olive,input[type='radio'].olive{
    background: #808000;
}
input[type='radio'].Yellow,input[type='radio'].yellow{
    background: #FFFF00;
}
input[type='radio'].Green,input[type='radio'].green{
    background: #008000;
}
input[type='radio'].Lime,input[type='radio'].lime{
    background: #00FF00;
}
input[type='radio'].Purple,input[type='radio'].purple{
    background: #800080;
}
input[type='radio'].Peru,input[type='radio'].peru{
    background: #CD853F;
}
input[type='radio'].Khaki,input[type='radio'].khaki{
    background: #F0E68C;
}
input[type='radio'].Silver,input[type='radio'].silver{
    background: #C0C0C0;
}

.bootstrap-select .bs-ok-default::after {
    width: 0.3em;
    height: 0.6em;
    border-width: 0 0.1em 0.1em 0;
    transform: rotate(45deg) translateY(0.5rem);
}

.btn.dropdown-toggle:focus {
    outline: none !important;
}

a.dropdown-item.selected {
    position: relative;
}


.checkbox-round,
.checkbox-round_disable {
    width: 25px;
    height: 25px;
    background-color: red;
    border-radius: 50%;
    vertical-align: middle;
    border: 2px solid #ddd;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
}

.checkbox-round:checked {
    border: 2px solid #0075ff;
    box-shadow: 0px 0px 5px;
}
.loader
{
    z-index:9999 !important;
}

.selected_sub {
    color: #6d6dff !important;
    font-weight: 700 !important;
}

/****** */
/* Variables */

/* form {
  width: 30vw;
  min-width: 500px;
  align-self: center;
  box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
  border-radius: 7px;
  padding: 40px;
} */

.hidden {
  display: none;
}

#payment-message {
  color: rgb(105, 115, 134);
  font-size: 16px;
  line-height: 20px;
  padding-top: 12px;
  text-align: center;
}

#payment-element {
  margin-bottom: 24px;
}

/* Buttons and links */
button {
  background: #5469d4;
  font-family: Arial, sans-serif;
  color: #ffffff;
  border-radius: 4px;
  border: 0;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: block;
  transition: all 0.2s ease;
  box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
  width: 100%;
}
button:hover {
  filter: contrast(115%);
}
button:disabled {
  opacity: 0.5;
  cursor: default;
}

/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
  border-radius: 50%;
}
.spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.spinner:before,
.spinner:after {
  position: absolute;
  content: "";
}
.spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: #5469d4;
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: #5469d4;
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@media only screen and (max-width: 600px) {
  form {
    width: 80vw;
    min-width: initial;
  }
}
/****** */

.gallery_image_view
    {
        width: 150px;
        height: 140px;
        object-fit: cover;
    }
	.gallery_image_view_con
    {
        cursor:pointer;
        border: solid 2px transparent;
        padding: 6px;
        height: 150px;
    }
    .gallery_image_view_con.active
    {
        border: solid 2px #abbde8;
    }
    .gallery_image_view_con:hover
    {
        border: solid 2px #abbde8;
    }

    </style>
    </head>

	<?php
        $stickyclass= "";
		$positionfixed = "";
		if(count($complete_settings) != 0)
		{
			if($complete_settings['header']['header_sticky']==1)
			{
				$stickyclass = "fixed-top";
				$positionfixed = "position:fixed;";
			}
		}
        ?>

<body style="overflow-y:hidden ">

<div id="overlay" class="loader" style="display:none;">
 <img  src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" alt="" class="spinner1">
</div>

<input type="hidden" id="all_products" value="{{json_encode($products)}}" />
		@if(\Session::get("cart"))
			<input type="hidden" class="cart_json" value='{{json_encode(Session::get("cart"))}}'>
		@else
			<input type="hidden" class="cart_json" value='[]'>
		@endif

		@if(\Session::get("product_for_shirt"))
			<input type="hidden" class="product_for_shirt_json" value='{{json_encode(Session::get("product_for_shirt"))}}'>
		@else
			<input type="hidden" class="product_for_shirt_json" value='[]'>
		@endif

		@if(\Session::get("cart_name"))
			<input type="hidden" class="cart_name_json" value='{{json_encode(Session::get("cart_name"))}}'>
		@else
			<input type="hidden" class="cart_name_json" value='[]'>
		@endif

		@if(\Session::get("cart_desc"))
			<input type="hidden" class="cart_desc_json" value='{{json_encode(Session::get("cart_desc"))}}'>
		@else
			<input type="hidden" class="cart_desc_json" value='[]'>
		@endif





	<div class="custom-margin" style="margin: 0px; display:none;" class="custom-margin">
        <div class="" id="total" style="cursor:pinter; font-size: 18px;display: inline;height: 100%;position: relative;top: 3px;">Total: $0</div>
    </div>

	<input type="hidden" id="ss_val" value="{{env('STRIPE_PUB_KEY_LIVE')}}" >

	<!--cart-->
    <div class="cart_container" style="padding: 10px;{{$positionfixed}}top: 80px;background: white;display:none;width: 100%;">
		<table class="table" style="line-height: 1.5rem;text-align: center;">
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Rate</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>
			<tbody class="tbody">
				<tr>
					<td colspan="5">Cart is empty.<td>
				<tr>
			</tbody>
		</table>
	</div>
	<!--cart-->

        <!--Header-->
        <header class="p-3 bg_header text-white {{$stickyclass}}" style="background-color:{{$complete_settings['header']['header_bg_color']}};">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center" style="justify-content: space-between !important;">
                <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="{{$complete_settings['header']['logo_path']}}" class="img-fluid"  id="logo_path_view" alt="logo image" style="object-fit: contain; height:40px; margin:5px 5px;" >
                </a>

                <div class="text-end" style="position:relative;">
                    <span aria-atomic="true" aria-label="Badge" aria-live="polite" role="status" class="v-badge__badge" style="background-color: rgb(255 0 0);"><span data-v-fbd834be="" class="badge-number" style="color: white;">0</span></span>
                    <i class="fa fa-shopping-cart cart_header" style="color:{{$complete_settings['header']['cart_icon_color']}}" aria-hidden="true"></i>
                </div>
                </div>
            </div>
        </header>

        @if($complete_settings['header']['header_sticky']==1)
            <div class="extra_space" style="height:82px;"></div>
        @endif
		<!--Header end-->

		<!-- Payment Code-->
		<!-- Display a payment form -->
		<div id="form_container" style="margin: 40px auto;width: 40%;display: none;">
			<div class="row">
				<span class="col-md-2 goto_checkout h3" style="">Back</span>
			</div>

			<form id="payment-form" >
				<div id="payment-element">

				</div>
				<button id="submit">
					<div class="spinner hidden" id="spinner"></div>
					<span id="button-text">Pay</span>
				</button>
				<div id="payment-message" class="hidden"></div>
			</form>
		</div>
	<!-- End Payment Code-->

		<!--Cart-->
		<div class="cart_container_new m-5" style="padding: 10px;background: white;display: none;overflow: hidden;">
			<div class="row">
				<span class="col-md-2 backtoshopping h3" style="">Back</span>
			</div>
			<h1>Shopping Cart</h1>
			<div class="row">
				<div class="col-md-9" id="shopping_cart_items">
					<div class="row my-4">
						<div class="col-md-2 picture">
						<img class="card-img-top  w-100" src="https://dashboard.blinkswag.com/storage/app/ItemImages/1316483000064528905.jpg" alt="Card image cap" style="height: auto;width: 150px;">
						</div>
						<div class="col-md-6 picture">
							<h2>Male Round Neck Half Sleeve</h2>
							<h5> Male Round Neck Half Sleeve </h5>
							<div class="col-md-8 p-0">
    							<span>size: 2XL</span>
								<span style="float: right;">qty: 1</span>
							</div>
							<h5 class="remove_item_cart" style="color:red;">Remove</h5>
						</div>
						<div class="col-md-4 picture text-center"> <h1>$18.75</h1> </div>
					</div>
					<div class="row my-4">
						<div class="col-md-2 picture">
						<img class="card-img-top  w-100" src="https://dashboard.blinkswag.com/storage/app/ItemImages/1316483000067123166.png" alt="Card image cap" style="height: auto;width: 150px;">
						</div>
						<div class="col-md-6 picture">
							<h2>Button Magnet, Round (1 & 10 pcs)</h2>
							<h5> Male Round Neck Half Sleeve </h5>
							<div class="col-md-8 p-0">
								<span>size: 2XL</span>
								<span style="float: right;">qty: 1</span>
							</div>
							<h5 class="remove_item_cart" style="color:red;">Remove</h5>
						</div>
						<div class="col-md-4 picture text-center"> <h1>$28.68</h1> </div>
					</div>


				</div>
				<div class="col-md-3">
					<h1>Order Summary</h1>
					<div class="summary_loader" style="display:none;">
						<div class="animated-background">
							<div class="background-masker btn-divide-left"></div>
						</div>
					</div>

					<div class="row my-2">
						<div class="col-md-6"> Price </div>
						<div class="col-md-6"> $<span class="shopping_cart_price">150.75</span></div>
					</div>
					<div class="row my-2">
						<div class="col-md-6"> Shipping rate </div>
						<div class="col-md-6"> $<span class="shipping_rate">0</span></div>
					</div>
					<!-- <div class="row my-2">
						<div class="col-md-6"> Delivery fee </div>
						<div class="col-md-6"> $15</div>
					</div> -->
					<div class="row my-2"><div class="col-md-12"><hr style="margin: 0px;width: 80%;"></div></div>
					<div class="row my-2">
						<div class="col-md-6"> <h2>Total</h2> </div>
						<div class="col-md-6"> <h2>$<span class="shopping_cart_total">165.75</span></h2> </div>
					</div>

					<div class="text-right mr-5">
						<a class="btn bg-default text-white goto_checkout" style="">
							Place Order
						</a>
					</div>
				</div>

			</div>
		</div>
		<!--Cart end-->

		<!--checkout-->
		<div class="checkout_container m-5" style="padding: 10px;background: white;{{$cartdisplay}}overflow: hidden;">
			<div class="row">
				<span class="col-md-2 backtocart h3" style="">Back</span>
			</div>
			<h1>Checkout</h1>
			<div class="row">
				<div class="col-md-7" id="checkout_delivery_form">
					<!-- -rw-no#.jpg -->
					@if( isset($googleuser) )
						<?php
						//dd( $googleuser );
						//dd( property_exists($googleuser,'address') );
						if($googleuser->address=="{}")
						{
							$address = [
								"address"=>"",
								"city"=>"",
								"street2"=>"",
								"state"=>"",
								"zip"=>"",
								"country"=>"",
								"attention"=>""
							];
						}else{
							$useraddress = json_decode($googleuser->address);
							$address = [
								"address"=>$useraddress->address,
								"city"=>$useraddress->city,
								"street2"=>$useraddress->street2,
								"state"=>$useraddress->state,
								"zip"=>$useraddress->zip,
								"country"=>$useraddress->country,
								"attention"=>$useraddress->attention
							];
							//$address['attention'] = $useraddress->attention;
						}
						?>
						<input type="hidden" id="googleuserid" value="{{$googleuser->id}}" class="form-control">
						<!-- <img src="{ { $ googleuser->avatar}}" style="vertical-align: middle;width: 50px;height: 50px;border-radius: 50%;" /> -->
						<h3 style="color:#32325d;">
							Welcome {{$googleuser->name}}!
							<span class="logoutlabel" style="position: absolute;font-size: 12px;margin-left: 10px;"> Logout </span>
						</h3>

						<h2>Delivery Info</h2>
						<div class="form_container" style="">
							<label>Full Name<span class="text-danger">*</span></label>
							<input type="text" value="{{$address['attention']}}" id="full_name" class="form-control">
							<!-- <label>Email<span class="text-danger">*</span></label>
							<input type="email" value="{ { $address['email']}}" id="email" class="form-control"> -->
							<label> Suite No/Street1<span class="text-danger">*</span></label>
							<input type="text" value="{{$address['address']}}" id="address" class="form-control">
							<label>Street2</label>
							<input type="text" value="{{$address['street2']}}" id="street2" class="form-control">
							<label>Zip <span class="text-danger">*</span></label>
							<input type="text" value="{{$address['zip']}}" id="zip" class="form-control">
							<label>Country <span class="text-danger">*</span></label>
							<select id="countryId" class="form-control countries gds-cr" country-data-region-id="gds-cr-one" country-data-default-value="{{$address['country']}}" ></select>
							<label>State <span class="text-danger">*</span></label>
							<select name="state" class="states form-control" id="gds-cr-one" region-data-default-value="{{$address['state']}}"></select>
							<label>City <span class="text-danger">*</span></label>
							<input type="text" value="{{$address['city']}}" name="city" class="cities form-control" id="cityId">
							<button class='btn bth-lg-primaty btn-block saveaddress'>
								<strong>Save</strong>
							</button>


						</div>
					@else
						<button class='btn bth-lg-primaty btn-block loginwithgoogle'>
							<strong>Login With Google</strong>
						</button>
						<!--Login-->
						<form action="" class="log_form login_form" method="post">
							<div class="imgcontainer">
								<i class="ni ni-single-02 avatar" ></i>
							</div>

							<div class="container">
								<label for="email"><b>Email</b></label>
								<input type="text" placeholder="Enter Email" class="email" name="email" required>

								<label for="psw"><b>Password</b></label>
								<input type="password" placeholder="Enter Password" class="password" name="psw" required>

								<div class="container2">
									<span class="signup" style="cursor:pointer; color:#5e72e4;">Signup</span>
									<!-- <button type="button" class="cancelbtn">Cancel</button> -->
									<span class="psw forget_password" style="cursor:pointer; color:#5e72e4;">Forgot password?</span>
								</div>

								<button type="button" class="submit_login">Login</button>
								<!-- <label>
								<input type="checkbox" checked="checked" name="remember"> Remember me
								</label> -->
							</div>
						</form>

						<!--signup-->
						<form action="" class="log_form signup_form" method="post" style="display:none;">
							<div class="imgcontainer">
								<i class="ni ni-single-02 avatar" ></i>
							</div>

							<div class="container">
								<label for="username"><b>Name</b></label>
								<input type="text" placeholder="Enter Username" class="name" name="name" required>

								<label for="email"><b>Email</b></label>
								<input type="text" placeholder="Enter Username" class="email" name="email" required>

								<label for="psw"><b>Password</b></label>
								<input type="password" placeholder="Enter Password" class="password" name="psw" required>

								<label for="re_psw"><b>Re-Password</b></label>
								<input type="password" placeholder="Enter Re-Password" class="re_password" name="re_psw" required>

								<div class="container2">
									<span class="signin" style="cursor:pointer; color:#5e72e4;">Signin</span>
									<span class="psw forget_password" style="cursor:pointer; color:#5e72e4;">Forgot password?</span>
								</div>
								<button type="button" class="submit_signup">Signup</button>
							</div>
						</form>

						<!--Forge Password-->
						<form action="" class="log_form forget_password_form" method="post" style="display:none;">
							<div class="imgcontainer">
								<i class="ni ni-single-02 avatar" ></i>
							</div>

							<div class="container">
								<label for="email"><b>Email</b></label>
								<input type="text" placeholder="Enter Email" class="email" name="email" required>

								<div class="container2">
									<span class="signup" style="cursor:pointer; color:#5e72e4;">Signup</span>
									<span class="psw signin" style="cursor:pointer; color:#5e72e4;">Signin</span>
								</div>

								<button type="button" class="submit_forget_password">Submit</button>
							</div>
						</form>
					@endif
				</div>
				<div class="col-md-5">
					<h1>Order Summary</h1>
					<label class="h5 delivery_days" style="color: #0389ff;"> Delivers in - Days </label>
					<div class="checkout_items">
						<div class="summary_loader" style="display:block;">
							<div class="animated-background">
								<div class="background-masker btn-divide-left"></div>
							</div>
						</div>

					</div>

					<div class="row my-2 px-3 text-center">
						<div class="col-md-6"> Price </div>
						<div class="col-md-6"> $<span class="shopping_cart_price">150.75</span></div>
					</div>
					<div class="row my-2 px-3 text-center">
						<div class="col-md-6"> Shipping rate </div>
						<div class="col-md-6"> $<span class="shipping_rate">0</span></div>
					</div>
					<div class="row my-2 px-3 text-center">
						<div class="col-md-6"> Tax rate </div>
						<div class="col-md-6"> $<span class="tax_rate">0</span></div>
					</div>
					<!-- <div class="row my-2">
						<div class="col-md-6"> Delivery fee </div>
						<div class="col-md-6"> $15</div>
					</div> -->
					<div class="row my-2 px-3"><div class="col-md-12"><hr style="margin: 0px;"></div></div>
					<div class="row my-2 px-3 text-center">
						<div class="col-md-6"> <h2>Total</h2> </div>
						<div class="col-md-6"> <h2>$<span class="shopping_cart_total">165.75</span></h2> </div>
						<span class="net_amount" val="0"></span>
					</div>
					@if(\Session::get("googleuser1"))
						<button class="btn btn-default" onclick="Checkout_new()" style="margin-top: 17px;width: 100%;">Pay Now</button>
					@else
						<button class="btn btn-default" disabled style="margin-top: 17px;width: 100%;">Pay Now</button>
					@endif
				</div>

			</div>
		</div>
		<!--checkout end-->


        <!--Slider-->
        @if($complete_settings['slider']['show_sider']==1)
            <div id="myCarousel" class="slider carousel slide" data-ride="carousel" style="{{$interface}}">
                <ol class="carousel-indicators">
                    @foreach($complete_settings['slider']['slides'] as $key=>$slide)
                        <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{($key==0) ? 'active':''}}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($complete_settings['slider']['slides'] as $key=>$slide)
                    <div class="carousel-item {{($key==0) ? 'active':''}}">
                        <img class="d-block w-100" id="slider{{($key+1)}}_path_view" src="{{$slide['image_path']}}">
                        <div class="carousel-caption d-none d-md-block" style="background-color:rgba({{hexToRgb($complete_settings['slider']['caption_bg_color'])}} / 78%);">
                            <h3 style="color:{{$complete_settings['slider']['caption_color']}}">{{$slide['title']}}</h3>
                            <p style="color:{{$complete_settings['slider']['caption_color']}}">{{$slide['description']}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
        <!--Slider-->

        <!--Banner-->
        @if($complete_settings['banner']['show_banner']==1)
        <div class="banner col-xxl-8 px-5" style="{{$interface}}">
            <div class="banner_bg_color_view" style="background-color:{{$complete_settings['banner']['banner_bg_color2']}}"></div>
            <div class="overlay" id="banner_overlay_path_view" style="background-image: url({{$complete_settings['banner']['banner_overlay_path']}});"></div>
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{$complete_settings['banner']['banner_path']}}" id="banner_path_view" class="d-block mx-lg-auto img-fluid banner_image_view" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3 banner_heading_view" style="color:{{$complete_settings['banner']['banner_text_color2']}}">{{$complete_settings['banner']['banner_heading']}}</h1>
                <p class="lead banner_description_view" style="color:{{$complete_settings['banner']['banner_text_color2']}}">{{$complete_settings['banner']['banner_description']}}</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="#products_container_selected" class="btn bg-default text-white" style="margin-top: 50px;font-weight:bold;background-color:{{$complete_settings['banner']['banner_cta_bg_color2']}} !important;">
                    {{$complete_settings['banner']['banner_cta_text']}}
                    </a>
                </div>
                </div>
            </div>
        </div>
        @endif
        <!--Banner-->

        <!--Selected products-->
        <div class="container text-center mt-5" id="products_container_selected" style="{{$interface}}">
        	<h3 style="color: #737373;">What We Do Products start Here</h3><br>

			@if( count($all_categories_details)==0 )
				<div> No Product is Available </div>
			@else
				<div class="row products_container_selected_printful">
					<?php
					$counter = 0;
					$all_category_titles = [];
					?>
					<div class="col-md-3 fixed-content">
						<h2 class="cat-heading">CATEGORIES</h2>
						<ul class="nav nav-tabs categories pb-4" id="myTab" role="tablist">
								<li class="nav-item dropdown">
									<a class="nav-link nav_link parentcategory getproducts_main navlinkmain active" category_id="all" data-toggle="tab" role="tab">All Products</a>
								</li>
							@foreach($all_categories_details as $k=>$category)
								@php
									if( !in_array($category['title'], $all_category_titles) )
									{
										@endphp
										<li class="nav-item dropdown pl-4">
											<a class="nav-link nav_link parentcategory getproducts_main navlink{{$category['id']}}" category_id="{{$category['id']}}" category_title="{{$category['title']}}" data-toggle="tab" role="tab">{{$category['title']}}</a>
										</li>
										@php
										array_push($all_category_titles, $category['title']);
									}
									$counter++;
								@endphp
							@endforeach
						</ul>
					</div>

					<div class="col-md-9 code-append" >
						<div class="sections section" data-cat-id="" >
								<div class="sections_custom section_custom" data-cat-id="" style="min-height: 100px;">
										<div class="tab-content">
											<div class="tab-pane active" id="tab-" role="tabpanel">
												<div class="row main-tab dev">
													@foreach($products as $key=>$product)
													<div class="col-md-4 product_cat_id product_cat_id{{$product->product->main_category_id}}" category_title="{{$all_categories_details[$product->product->main_category_id]['title']}}" product_id="{{$product->product->id}}" product_index="{{$key}}">
															<div class="content-box">

																	<div class="product-image ">
																		<!-- <img class="img-fluid" src="{{ $product->product->image}}"> -->
																		<?php
																			$flag = 0;
																			$dir = public_path('Image/'.$store->id_company.'/mockups/'.$my_editing[$key]->id);
																			if (is_dir($dir)) {
																				if ($dh = opendir($dir)) {
																					while (($file = readdir($dh)) !== false) {
																						if($file!="." && $file!=".." && str_contains($file, $product->variants[0]->id))
																						{
																							if($file=="front_".$product->variants[0]->id.".png")
																							{
																								$flag=1;
																								echo "<img class='img-fluid' src='".url('/').'/Image/'.$store->id_company.'/mockups/'.$my_editing[$key]->id.'/'.$file."'>";
																							}
																						}
																					}
																					closedir($dh);
																				}
																			}
																			if($flag!=1)
																			{
																			?>
																				<img class="img-fluid" src="{{ $product->product->image}}">
																			<?php
																			}
																		?>
																	</div>
																	<div class="product-title">
																		<p><strong>{{$my_editing_products[$key]->product_name}}</strong></p>
																	</div>
															</div>
														</div>
													@endforeach
												</div>

											</div>

										</div>
									</div>

						</div>
					</div>
				</div>
			@endif


			<div class="row products_container_selected" style="display:none;">
				@php
				$products = array();
				$count = 0;
				@endphp

				@foreach ($item_groups as $groups)
					<div class="col-xl-3 col-lg-6" style="margin: 30px">
						<div class="card"
							style="width: 19rem;border-radius: 10px;">

							<div class="get_details_id" item_id="{{ $groups['items'][0]['item_id'] }}"
								style="display: flex;align-items: center;height: 240px;flex-wrap: nowrap;align-content: center;justify-content: center;">

								@php
								$is_image = 0;
								$inner_fields = "{}";
								if( array_key_exists($groups['group_id'], $item_json_fields) )
								{
									$inner_fields = json_decode($item_json_fields[ $groups['group_id'] ]);
									foreach($inner_fields as $key=>$value)
									{
										if($value->field_type=="url")
										{
											//echo $value->field_type."<br>".$value->field_name;
											$is_image = 1;
											@endphp
											<img class="card-img-top" src="{{$value->field_name}}" alt="Card image cap" style="height: auto;width: 150px;">
											@php
											break;
										}
									}
								}

								if($is_image==0)
								{
									@endphp
									<img class="card-img-top"
									src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $groups['items'][0]['item_id'] }}.{{ $groups['items'][0]['image_type'] }}"
									alt="Card image cap" style="height: auto;width: 150px;">
									@php
								}
								@endphp
							</div>

							<div class="card-body" >

								<img class="eye_icon" item_id="{{ $groups['items'][0]['item_id'] }}" data-id="{{ $groups['group_id'] }}" data-toggle="modal" data-target="#items{{$groups['group_id']}}" src="{{env('APP_URL')}}/public/assets/img/eye-icon.png"></img>
								<h4 class="get_details_id" item_id="{{ $groups['items'][0]['item_id'] }}" style="margin-bottom:10px">{{ $groups['group_name'] }} 	</h4>
								<span style="color:#0F2440;opacity: 0.6;">Starting at</span> <span style="font-weight: 600;">${{ $groups['items'][0]['rate'] }}     </span>
							</div>

						</div>
					</div>
				@endforeach

				@foreach ($items as $item)
					<div class="col-xl-3 col-lg-6" style="margin: 30px">
						<div class="card"
							style="width: 19rem;border-radius: 10px;">



							<div class="get_details_id"
								style="display: flex;align-items: center;height: 240px;flex-wrap: nowrap;align-content: center;justify-content: center;">

								@php
								$is_image = 0;
								$inner_fields = "{}";
								if( array_key_exists($item['item_id'], $item_json_fields) )
								{
									$inner_fields = json_decode($item_json_fields[ $item['item_id'] ]);
									foreach($inner_fields as $key=>$value)
									{
										if($value->field_type=="url")
										{
											$is_image = 1;
											@endphp
											<img class="card-img-top" src="{{$value->field_name}}" onclick="previewImg(this)" alt="Card image cap" style="height: auto;width: 150px;">
											@php
											break;
										}
									}
								}

								if($is_image==0)
								{
									@endphp
									<img class="card-img-top"
									src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}"
									onclick="previewImg(this)" alt="Card image cap" style="height: auto;width: 150px;">
									<!-- <img class="card-img-top" src="https://inventory.zoho.com/DocTemplates_ItemImage_{ { $ item['image_document_id']}}.zbfs" alt="Card image cap" style="height: auto;width: 150px;" /> -->
									@php
								}
								@endphp

							</div>

							<div class="card-body">

								<img class="eye_icon" item_id="{{ $item['item_id'] }}" data-id="{{ $item['item_id'] }}" data-toggle="modal" data-target="#item{{$item['item_id']}}" src="{{env('APP_URL')}}/public/assets/img/eye-icon.png"></img>
								<h4 class="get_details_id" style="margin-bottom:10px">{{ $item['name'] }} 	</h4>
								<span style="color:#0F2440;opacity: 0.6;">Starting at</span> <span style="font-weight: 600;">${{ $item['rate'] }}     </span>
							</div>

						</div>
					</div>
				@endforeach
			</div>
        </div><br>
        <!--Selected products-->

        <!--Footer-->
        <div class="footer-basic" style="background-color:{{$complete_settings['footer']['footer_bg_color2']}}">
            <footer>
                <div class="social" style="color:{{$complete_settings['footer']['footer_icon_color2']}}">
                    <a class="instagram" target="_blank" href="{{$complete_settings['footer']['instagram_text']}}"><i class="icon ion-social-instagram"></i></a>
                    <a class="snapchat" target="_blank" href="{{$complete_settings['footer']['snapchat_text']}}"><i class="icon ion-social-snapchat"></i></a>
                    <a class="twitter" target="_blank" href="{{$complete_settings['footer']['twitter_text']}}"><i class="icon ion-social-twitter"></i></a>
                    <a class="facebook" target="_blank" href="{{$complete_settings['footer']['facebook_text']}}"><i class="icon ion-social-facebook"></i></a>
                </div>
                <p class="copyright" style="color:{{$complete_settings['footer']['footer_text_color2']}}">{{$complete_settings['footer']['company_name']}} © 2022</p>
            </footer>
        </div>
        <!--Footer-->

		<div class="addProductDetails">

		</div>

        	<!-- On Demand Model Box -->
    @foreach ($items as $item)
			<div class="modal fade demand" id="item{{$item['item_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog demand_items" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{$item['name']}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body" style="overflow:auto; padding: 1.25rem;">
					<div class="row">
						<!-- <div class="col-md-6">
							<img class="card-img-top" src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}" onclick="previewImg(this)" alt="Card image cap" >
						</div> -->

						@php
						$is_image = 0;
						$inner_fields = "{}";
						if( array_key_exists($item['item_id'], $item_json_fields) )
						{
							$inner_fields = json_decode($item_json_fields[ $item['item_id'] ]);
							foreach($inner_fields as $key=>$value)
							{
								if($value->field_type=="url")
								{
									//echo $value->field_type."<br>".$value->field_name;
									$is_image = 1;
									@endphp
									<div class="col-md-6">
										<img class="card-img-top123" src="{{$value->field_name}}" onclick="previewImg(this)" alt="Card image cap" >
									</div>
									@php
									break;
								}
							}
						}

						if($is_image==0)
						{
							@endphp
							<div class="col-md-6">
								<img class="card-img-top" src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}" onclick="previewImg(this)" alt="Card image cap" >
							</div>
							@php
						}
						@endphp

						<div class="col-md-6">
						<h1> {{ $item['name'] }} </h1>
							<div class="product-prices mt-2 mb-2">
								<div class="current-price">${{ $item['rate'] }}
								</div>
							</div>
							<div class="description">
								<p>{!!nl2br($item['description'])!!}</p>
							</div>

							<div class="product-add-to-cart label-full-width">

							@if( array_key_exists('custom_fields', $item) )
								@foreach($item['custom_fields'] as $key=>$field)

									@if( $field['api_name']=="cf_choose_your_size" )
										<select  data-id="{{ $item['item_id'] }}"  id="sizeshirt{{$item['item_id']}}"   class="form-control" style="width:60%;margin-top:18px">
											<option value=""> Choose Size </option>
											@foreach(explode(',', $field['value']) as $data)
												<option  value="{{$data}}">{{$data}}</option>
											@endforeach
										</select>
									@endif

									@if( $field['api_name']=="cf_mon_fri" )
									<label>Mon - Fri
										<input  type="text"  id="mon_fri{{$item['item_id']}}" value="{{$field['value']}}" class="form-control">
									</label>
									@endif
									@if( $field['api_name']=="cf_saturday" )
									<label>Sat
										<input  type="text" id="sat{{$item['item_id']}}" value="{{$field['value']}}" class="form-control">
									</label>
									@endif
									@if( $field['api_name']=="cf_sunday" )
									<label>Sun
										<input  type="text" id="sun{{$item['item_id']}}" value="{{$field['value']}}" class="form-control">
									</label>
									@endif
									@if( $field['api_name']=="cf_unit_label" )
									<label>Unit Label
										<input  type="text" id="moq{{$item['item_id']}}" value="{{$field['value']}}" class="form-control">
									</label>
									@endif
								@endforeach
							@endif



							@php
							$inner_fields = "{}";
							if( array_key_exists($item['item_id'], $item_json_fields) )
							{
								$inner_fields = json_decode($item_json_fields[ $item['item_id'] ]);
								//print_r($inner_fields);
								foreach($inner_fields as $key=>$value)
								{
									if($value->field_type=="url")
									{
										continue;
									}
									//echo $value->field_type;
									//break;
									@endphp
									<label><?=$value->field_name?>
										<input  type="<?=$value->field_type?>" name="<?=$value->field_name.$key?>" placeholder="<?=$value->field_name?>" <?=($value->ischecked=="true") ? "required":""?> value="" class="form-control userdefine_fields">
									</label>
									@php
								}
							}
							@endphp

							<span class="control-label"><strong>Quantity</strong></span>
								<div class="product-quantity clearfix">
								@php
									$cf_choose_your_size = false;
									$cf_mon_fri = false;
									$cf_saturday = false;
									$cf_sunday = false;
									$cf_moq = false;

									$cf_on_demand = "";
									@endphp
									@if( array_key_exists('custom_fields', $item) )
										@foreach($item['custom_fields'] as $key=>$field)
											@if( $field['api_name']=="cf_choose_your_size" )
											 @php $cf_choose_your_size = true; @endphp
											@endif
											@if( $field['api_name']=="cf_mon_fri" )
											 @php $cf_mon_fri = true; @endphp
											@endif
											@if( $field['api_name']=="cf_saturday" )
											 @php $cf_saturday = true; @endphp
											@endif
											@if( $field['api_name']=="cf_sunday" )
											 @php $cf_sunday = true; @endphp
											@endif
											@if( $field['api_name']=="cf_moq" )
											 @php $cf_moq = true; @endphp
											@endif
											@if( $field['api_name']=="cf_on_demand" )
											 @php $cf_on_demand =  $field['value']; @endphp
											@endif
										@endforeach
									@endif
								<div class="qty">
								  <div class="bootstrap-touchspin">

								  	@if( array_key_exists("reorder_level", $item) && $item['reorder_level']!="" )
									  	<input type="number" id="{{ $item['item_id'] }}" min="{{$item['reorder_level']}}" value="{{$item['reorder_level']}}" class="form-control min_qty_validation" style="width:70px; float: left;">
									@else
										<input type="number" id="{{ $item['item_id'] }}" value=1 class="form-control" style="width:70px; float: left;">
									@endif


								   <button class="btn btn-default ml-3"  data-item-rate="{{ $item['rate'] }}"
									data-item-id="{{ $item['item_id'] }}" data-item-name="{{ $item['name'] }}" data-soh="{{$item['stock_on_hand']}}" data-cf_on_demand="{{$cf_on_demand}}"
									@if ($cf_choose_your_size) data-item-shirt="sizeshirt{{$item['item_id'] }}"  @endif
									@if ($cf_mon_fri)  data-item-mon-fri="mon_fri{{$item['item_id'] }}" @endif
									@if ($cf_saturday)  data-item-sat="sat{{$item['item_id'] }}" @endif
									@if ($cf_sunday)  data-item-sun="sun{{$item['item_id'] }}" @endif
									@if ($cf_moq)  data-item-moq="moq{{$item['item_id'] }}" @endif
									data-item-image="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}"
									data-item-desc="{{$item['description'] }}"
									onclick="additemtocart(this)" >Add to cart </button>
									</div>
								</div>
								<!-- <div class="add">
								</div> -->
								</div>
								@if( array_key_exists("reorder_level", $item) && $item['reorder_level']!="" )
									<p style="color: red;">This item has minimum order quantity of {{$item['reorder_level']}}.</p>
								@endif
							</div>
						</div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
	@endforeach

    <!-- group Item Model -->
 @foreach ($item_groups as $kk=>$groups)
<div class="modal fade my-items" id="items{{$groups['group_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog items" style="max-width: 64rem;" role="document">
    <div  id="model_container" class="modal-content ">

      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
			<span aria-hidden="true">&times;</span>
			</button>
	  <div class="row">
        <div class="col-md-6 col-sm-6 hidden-xs-down single_image">
            <div class="images-container">

			@php
			$is_image = 0;
			$inner_fields = "{}";
			if( array_key_exists($groups['group_id'], $item_json_fields) )
			{
				$inner_fields = json_decode($item_json_fields[ $groups['group_id'] ]);
				foreach($inner_fields as $key=>$value)
				{
					if($value->field_type=="url")
					{
						//echo $value->field_type."<br>".$value->field_name;
						$is_image = 1;
						@endphp
						<img class="js-qv-product-cover card-img-top" src="{{$value->field_name}}" alt="Card image cap">
						@php
						break;
					}
				}
			}

			if($is_image==0)
			{
				@endphp
				<div class="product-cover{{$groups['group_id']}}">
				@foreach ($groups['items'] as $key => $group)

				@if(
						( true || array_key_exists('actual_available_stock', $group)
						&& $group['actual_available_stock'] > 0
						) || ( array_key_exists('cf_on_demand', $group)
							&& $group['cf_on_demand'] == 'true'
							)
					)
				<img class="js-qv-product-cover card-img-top"
					src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $group['item_id'] }}.{{ $group['image_type'] }}"
					alt="Card image cap">
					<!-- <img class="card-img-top" src="https://inventory.zoho.com/DocTemplates_ItemImage_{ {$ group['image_document_id' ]}}.zbfs" alt="Card image cap" /> -->
				@php break;
				@endphp
				@endif
				@endforeach
				</div>
				@php
			}
			@endphp
        </div>
        </div>

		<!-- <div class="col-md-6 carousel_images" style="display: none;">
			<div id="carouselExampleControls{{$groups['group_id']}}" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
					<img class="d-block w-100" src="..." alt="First slide">
					</div>
					<div class="carousel-item">
					<img class="d-block w-100" src="..." alt="Second slide">
					</div>
					<div class="carousel-item">
					<img class="d-block w-100" src="..." alt="Third slide">
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls{{$groups['group_id']}}" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls{{$groups['group_id']}}" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div> -->


        <div class="col-md-6 col-sm-6">
          <h1 class="contents{{$groups['group_id']}}"> {{$groups['group_name']}}</h1>
		    <div class="product-prices mt-2 mb-2">
				<div >$ <span class="current-price{{$groups['group_id']}}">{{$groups['items'][0]['rate']}} </span>
				</div>
			</div>
				<div class="description">
					{!!nl2br($groups['description'])!!}
				</div>

            <div class="product-actions">


				<div class="product-variants">


					@if($groups['items'][0]['attribute_option_name2'])
					<div class="clearfix product-variants-item mt-3">
						<strong class="control-label"> {{$groups['attribute_name2']}} Available</strong>
						<select class="form-control form-control-select size_value attr_size{{$groups['group_id']}}" id="attribute_size"  data-id="{{$groups['group_id']}}" data-index="{{$kk}}" data-item-index="{{$key}}"  name="size">
							  @php
							$newArray = array();
							$usedcolor = array();
							@endphp
							@foreach ($groups['items'] as $key => $group)
							@if((true || array_key_exists('actual_available_stock', $group) && $group['actual_available_stock'] > 0 ) || (array_key_exists('actual_available_stock', $group) && array_key_exists('cf_on_demand', $group) && $group['cf_on_demand'] == 'true') ) -->

							@if ( !in_array($group['attribute_option_name2'], $usedcolor) )
							@php
							$usedcolor[] = $group['attribute_option_name2'];
							$newArray[$key] = $group;
							@endphp
							@endif
							@endif
							@endforeach
							@php
							$result_groups = $newArray;
							$newArray = NULL;
							$usedFruits = NULL;
							@endphp

							<option value="">Select {{$groups['attribute_name2']}}</option>
							@foreach ($result_groups as $kkk=>$group)
								<option value="{{$group['attribute_option_id2']}}" data-item-id="{{$group['item_id']}}" data-index="{{$kkk}}" >{{$group['attribute_option_name2']}}</option>

							@endforeach
						  </select>
					</div>
					<div class="clearfix product-variants-item color_attribute{{$groups['group_id']}} mt-3" style="display:none;">
						<div class="" >
							<strong class="control-label">Select {{$groups['attribute_name1']}}</strong>
							<ul class="color_attribute_inner{{$groups['group_id']}}" style="list-style:none;padding:0;margin-top:10px">
							</ul>
						</div>

					</div>

				@else

					<!-- @ if( array_key_exists("attribute_option_name1", $groups) ) -->
					@if( $groups['items'][0]['attribute_option_name1'])
					  <div class="clearfix product-variants-item mt-3">
						<strong class="control-label">Select {{$groups['attribute_name1']}}</strong>

						<ul id="color" style="list-style:none;padding:0;margin-top:10px">
							@php
							$newArray = array();
							$usedcolor = array();
							@endphp
							@foreach ($groups['items'] as $key => $group)
							@if( true ||  ( array_key_exists('actual_available_stock', $group) ) || (array_key_exists('actual_available_stock', $group) ) )

							@if(( true || array_key_exists('actual_available_stock', $group) && $group['actual_available_stock'] > 0  ) )
							@php
							$usedcolor[] = $group['attribute_option_name1'];
							$newArray[$key] = $group;
							@endphp
							@endif
							@endif
							@endforeach
							@php
							$result_groups = $newArray;
							$newArray = NULL;
							$usedFruits = NULL;
							$key = 0;
							@endphp




						@foreach ($result_groups as $key => $group)
						@if($group['status'] == 'active')

						<li class="float-xs-left input-container">
						  <label>
							<input type="radio" onclick="changeImage(this)" data-group-index="{{$kk}}" data-item-index="{{$key}}" data-item-id="{{$group['item_id']}}"  data-group="{{$groups['group_id']}}" data-id="{{$group['attribute_option_id1']}}" id="{{$group['attribute_option_id1']}}"  class="color{{$key++}} radio_box"   name="color{{$groups['group_id']}}" color-item-id="{{$group['attribute_option_id1']}}" value="{{$group['attribute_option_id1']}}"  />
							<span class="color" >{{$group['attribute_option_name1']}}</span>
						  </label>
						</li>
						@endif

							@endforeach
						</ul>
						</div>
				  @endif
				  	@endif
				</div>

                <div class="product-add-to-cart">

				<div class="unit_label{{$groups['group_id']}}">
				</div>

				<div class="mon_fri_label{{$groups['group_id']}}">
				</div>

				<div class="sat_label{{$groups['group_id']}}">
				</div>

				<div class="sun_label{{$groups['group_id']}} mb-3">
				</div>

				@php
				$inner_fields = "{}";
				if( array_key_exists($groups['group_id'], $item_json_fields) )
				{
					$inner_fields = json_decode($item_json_fields[ $groups['group_id'] ]);
					//print_r($inner_fields);
					foreach($inner_fields as $key=>$value)
					{
						if($value->field_type=="url")
						{
							continue;
						}
						//break;
						@endphp
						<label style="width: 100%;"><?=$value->field_name?>
							<input  type="<?=$value->field_type?>" name="<?=$value->field_name?>" placeholder="<?=$value->field_name?>" <?=($value->ischecked=="true") ? "required":""?> value="" class="form-control userdefine_fields">
						</label>
						@php
					}
				}
				@endphp

				<span class="control-label"><strong>Quantity</strong></span>
				  <div class="product-quantity clearfix">

					<div class="qty{{$groups['group_id']}}">
					  <div class=" bootstrap-touchspin">
					  	@if( array_key_exists("reorder_level", $groups['items'][0]) && $groups['items'][0]['reorder_level']!="" )
						  <input type="number" name="qty" min="{{$groups['items'][0]['reorder_level']}}" value="{{$groups['items'][0]['reorder_level']}}" class="input-group form-control product_qty min_qty_validation" id="{{$groups['group_id']}}"  min="1" aria-label="Quantity" style="max-width: 70px;float: left;">
						@else
						<input type="number" name="qty" value="1" class="input-group form-control product_qty" id="{{$groups['group_id']}}"  min="1" aria-label="Quantity" style="max-width: 70px;float: left;">
						@endif

						<button class="btn btn-default add-to-cart add_cart_group ml-3" style="color:#fff;"   onclick="additemtocartgroup(this)"  name="color{{$groups['group_id']}}"  data-item-name="{{$groups['group_name']}}"
						data-item-unit="unit{{$groups['group_id']}}"
						data-item-mon-fri="mon_fri{{$groups['group_id']}}"
						data-item-sat="sat{{$groups['group_id']}}"
						data-item-sun="sun{{$groups['group_id']}}"
						data-item-id="{{$groups['group_id']}}"
						data-group-index="{{$kk}}">
							Add to cart
			</button>
					  </div>
					</div>

					<!-- <div class="add">

					</div> -->
				  </div>
				  @if( array_key_exists("reorder_level", $groups['items'][0]) && $groups['items'][0]['reorder_level']!="" )
						<p style="color: red;">This item has minimum order quantity of {{ $groups['items'][0]['reorder_level']}}.</p>
				  @endif
				</div>
			</div>

        </div>
      </div>
      </div>

    </div>
  </div>
</div>
@endforeach

</body>

<script src="{{('public/assets/js/geodatasource.js')}}"></script>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    //wsmemon
	window._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	window.products = JSON.parse($("#all_products").val());
	window.my_editing = @json($my_editing_products);
	window.general_my_editing = @json($my_editing);
	window.general_my_editing_single = "";
	//console.log("general_my_editing", general_my_editing);

	setTimeout(function(){
        $(".getproducts_main:first").trigger("click");
    }, 100);

	$(document).on("click",".getproducts_main", function(){
        var category_id = $(this).attr("category_id");
		var category_title = $(this).attr("category_title");
		//console.log("category_title", category_title);

		if(category_id=="all")
		{
			$(".product_cat_id").show();
		}else{
			$(".product_cat_id").hide();
			//$(".product_cat_id"+category_id).show();
			$("[category_title='"+category_title+"']").show();

		}
    });
	$(document).on("click",".product_cat_id", function(){
        $(".loader").show();
        var product_id = $(this).attr("product_id");
		var product_index = $(this).attr("product_index");
        var selected_product = products[product_index];
		var selected_editing = my_editing[product_index];
		var product_list_id = general_my_editing[product_index]['id'];

		general_my_editing_single = general_my_editing[product_index];

        $(".loader").show();
        $.ajax({
            type: "POST",
            dataType:'html',
            data: {
                selected_product: selected_product,
				selected_editing: selected_editing,
				general_my_editing_single: general_my_editing_single,
				product_list_id: product_list_id,
				id_company: "{{$store->id_company}}",
                _token: _token
            },
            url: "{{$domain_name}}/printful/getProductDetails_popup",
            async: true,
            success: function(data) {
                $(".addProductDetails").html(data);
                $(".loader").hide();
                $("#product_details_modal").modal("show");
            }
        })
    });


	$(document).on("change",".change_mockup", function(){
		var variant_id = $(this).attr("variant_id");
		console.log("variant_id", variant_id);
		var product_id = $(this).attr("product_id");
		console.log("product_id", product_id);
		$(".loader").show();
        $.ajax({
            type: "POST",
            dataType:'html',
            data: {
                variant_id: variant_id,
				product_id: product_id,
				id_company: "{{$store->id_company}}",
                _token: _token
            },
            url: "{{$domain_name}}/printful/getProductmockups_popup",
            async: true,
            success: function(data) {
                console.log(data);
				$(".single_image").html(data);
				//$(".addProductDetails").html(data);
                $(".loader").hide();
            }
        })
	});

	$(document).on("change",".checkbox_size:not(.change_mockup_2), .checkbox_color:not(.change_mockup)", function(){
		//return false;
		var selected_size = $("[name='selected_size']:checked").val();
		var selected_color = $("[name='selected_color']:checked").val();

		if(typeof(selected_size)!="undefined" && typeof(selected_color)!="undefined")
		{
			$(".loader").show();
			//console.log(selected_size, selected_color);
			//console.log(general_my_editing_single);
			if(general_my_editing_single=="")
			{
				console.log("Something Went Wrong.");
				return false;
			}else{
				var json_variants 	= JSON.parse( general_my_editing_single['selected_variants'][0], true );
				var profit_price 	= general_my_editing_single['my_editing']['profit_price'];
				//console.log("json_variants", json_variants);
				json_variants.forEach(function(value, index){
					//console.log("value", value);
					if(value['size']==selected_size && value['color_code']==selected_color)
					{
						$("#product_details_modal img.modal_product_image").attr("src",value.image);
						var total_product_price = parseFloat(value.price) + parseFloat((value.price/100)*40) + parseFloat(profit_price);
						console.log("total_product_price", total_product_price);
						$(".modal_product_price").text( total_product_price );
						value['total_product_price'] = total_product_price;

						console.log("value", value);
						$(".loader").hide();
						return false;
					}
				});

			}
		}
	});

	function addtoproductlist()
	{
		var selected_size = $("[name='selected_size']:checked").val();
		var selected_color = $("[name='selected_color']:checked").val();

		if( typeof(selected_size)=="undefined" || typeof(selected_color)=="undefined" )
		{
			alertify.error("Please Select the Available SIze/Color.");
			return false;
		}
		$(".loader").show();
		if(typeof(selected_size)!="undefined" && typeof(selected_color)!="undefined")
		{
			if(general_my_editing_single=="")
			{
				console.log("Something Went Wrong.");
				return false;
			}else{
				var json_variants 	= JSON.parse( general_my_editing_single['selected_variants'][0], true );
				var profit_price 	= general_my_editing_single['my_editing']['profit_price'];
				json_variants.forEach(function(value, index){
					if(value['size']==selected_size && value['color_code']==selected_color)
					{
						$("#product_details_modal img.modal_product_image").attr("src",value.image);
						var total_product_price = parseFloat(value.price) + parseFloat((value.price/100)*40) + parseFloat(profit_price);
						console.log("total_product_price", total_product_price);
						$(".modal_product_price").text( total_product_price );

						value['total_product_price'] = total_product_price;
						value['isprintful'] = 1;
						value['description'] = $("#product_details_modal div.modal_product_description").text();
						value['quantity'] = 1;
						value['edit_name'] = $(".modal_product_name").text().replace(/[^a-zA-Z0-9 ]/g, '');
						//console.log("value", value);
						//return false;
						////////////////////////////////////
						if($(".frontimage:visible").length>0)
						{
							value['image'] = $(".frontimage").find("img:first").attr("src");
						}

						cart.push(value)
						// product_for_shirt.push({
						// 	"product_name": $(".modal_product_name").text().replace(/[^a-zA-Z0-9 ]/g, ''),
						// 	"Product_Image_URL": value.image
						// });
						var rate = total_product_price;
						var quantity = 1;
                        var sum = rate * quantity;
                        total += sum

						alertify.success("Product added to cart");
						$("#product_details_modal").modal("hide");

						cart_name.push( $("#product_details_modal h1.modal_product_name").text() );
						cart_desc.push( $("#product_details_modal div.modal_product_description").text()  );
						refresh_cart_container();
						////////////////////////////////////

						console.log("value", value);
						$(".loader").hide();
						return false;
					}
				});
			}
		}
	}
	//wsmemon

    function shirtsize(sel) {
		 var datavalue = document.getElementById("tshirt").value;
		 var item_id = sel.getAttribute("data-id");
		  $("#sizeshirt"+item_id).attr('data-item-shirt', datavalue);
		}

        //var cart = [];
		//var product_for_shirt = [];

		var cart = JSON.parse($(".cart_json").val());
		var product_for_shirt = JSON.parse($(".product_for_shirt_json").val());





		//var cart_name = [];
		//var cart_desc = [];
		var cart_name = JSON.parse($(".cart_name_json").val());
		var cart_desc = JSON.parse($(".cart_desc_json").val());


		var fd = new FormData();
		var i=0;

        var limit = {{ $limit }};
        var total = 0;
        var check_email = '{{ $email }}';
        var consumed = {{ $consumed }};
        var modal = document.getElementById("myModal")

        //var pageid = { { $pageid }};
        //var id_company = '{ { $id_company }}';
		//var id_category = '{ { $id_category }}';

        function next() {

            if (total > 0) {
                document.getElementById("checkoutmodal").click();
            } else {
                alertify.error("Cart is empty")
            }
        }

        function additemtocart(elem) {

			var flag = false;
			$(".userdefine_fields[required]:visible").each(function(index, value){
				//console.log("value", value);
                if( $(value).val()=="" )
                {
                    alertify.error("Please fill the required fields");
					flag = true;
					return false;
                }
			});
			if(flag){
				return false;
			}



            itemid = elem.getAttribute("data-item-id")
			soh = elem.getAttribute("data-soh");
            cf_on_demand = elem.getAttribute("data-cf_on_demand")
            rate = elem.getAttribute("data-item-rate")
            quantity = parseInt(document.getElementById(itemid).value)
			itemimage= elem.getAttribute("data-item-image")
			itemdesc= elem.getAttribute("data-item-desc")


			var item_shirtsize =  document.getElementById(elem.getAttribute("data-item-shirt"));
            var item_mon_fri =  document.getElementById(elem.getAttribute("data-item-mon-fri"));
			var item_sat =  document.getElementById(elem.getAttribute("data-item-sat"));
			var item_sun =  document.getElementById(elem.getAttribute("data-item-sun"));
			var item_moq =  document.getElementById(elem.getAttribute("data-item-moq"));

			if(item_shirtsize != null){
				var shirt_size = item_shirtsize.value;
			}

			if(item_mon_fri != null){
				var mon_fri = item_mon_fri.value;
			}

			if(item_sat != null){
				var sat = item_sat.value;
			}


			if(item_sun != null){
				var sun = item_sun.value;
			}

			if(item_moq != null){
				var unit = item_moq.value;
			}

            sum = rate * quantity;

            // check = sum + total;


            // if (check > limit) {
            //     alertify.error("Not enough Funds");
            // } else {

				if(cf_on_demand==false || cf_on_demand==0 || cf_on_demand=="")
				{
					if (quantity > soh) {
						alertify.error("Quantity can not exceed Stock");
						return false;
					}
				}
				if (quantity == 0) {
                    alertify.error("Quantity can not be 0");
				}else {
                    incart = 0;
                    cart.forEach((elem) => {
                        if (elem["item_id"] == itemid) {
                            incart = parseInt(elem["quantity"])
                        }
                    })
                    if (incart > 0) {
                        final_qty = incart + quantity
						if(cf_on_demand==false || cf_on_demand==0 || cf_on_demand=="")
						{
							if (final_qty > soh) {
								alertify.error("Quantity can not exceed Stock");
								return false;
							}
						}
                        // if (final_qty > soh) {
                        //     alertify.error("Quantity can not exceed Stock");
                        // } else {
                            cart.forEach((elem) => {
                                if (elem['item_id'] == itemid) {
                                    elem['quantity'] = final_qty;
                                }
                            })
                            alertify.success("Product added to cart");
                            sum = rate * quantity;
                            total += sum
                            document.getElementById("total").innerText = "Total: " + Math.round(total) + "$";
                        //}

						$(".modal").modal("hide");
						refresh_cart_container();
                    } else {
                        cart.push({
                            "item_id": itemid,
                            "quantity": quantity,
                            "rate": rate,
                            "unit": "qty",
							"item_custom_fields": [
							{
							"api_name": "cf_proof_url",
							"placeholder": "cf_proof_url",
							"value": itemimage
							}
               				 ]
                        })
						product_for_shirt.push({
							"Apparel_Size": shirt_size,
							"Unit_Label" : unit,
							"Mon_Fri" : mon_fri,
							"Sat" : sat,
							"Sun" : sun
						})


						// $(".userdefine_fields:visible").each(function(index, value){
						// 	if(value.type == 'file'){
						// 		var fieldName = value.name;
						// 		var file_data = $('input[name="'+fieldName+'"]:visible').prop("files")[0];
						// 		i++;
						// 		fd.append("image"+i, file_data);
						// 		fd.append("index", i);
						// 	}else{
						// 		product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = $(value).val();
						// 	}
						// });
						var imageIndex = 0;
						$(".userdefine_fields:visible").each(function(index, value){
							if(value.type == 'file'){
								var fieldName = value.name;
								//var file_data = $('input[name="'+fieldName+'"]:visible').prop("files")[0];
								//product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = file_data;
								//product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = window.URL.createObjectURL($('input[name="'+fieldName+'"]:visible').prop("files"));

								// var file = $('input[name="'+fieldName+'"]:visible').prop("files")[0];
								// var imageType = /image.*/;
								// if (file.type.match(imageType)) {
								// 	var reader = new FileReader();
								// 	reader.onload = function(e) {
								// 		console.log( reader.result ); //Data URL String of file
								// 		product_for_shirt["image_"+itemid+"_"+imageIndex] = reader.result;
								// 		//sessionStorage.setItem("image_"+itemid+"_"+imageIndex, reader.result);
								// 		imageIndex++;
								// 	}
								// 	reader.readAsDataURL(file);
								// } else {
								// 	console.log("File not supported!");
								// }
							}else{
								product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = $(value).val();
							}
						});
                        sum = rate * quantity;
                        total += sum
                        document.getElementById("total").innerText = "Total: " + Math.round(total) + "$";
                        alertify.success("Product added to cart");
						$(".modal").modal("hide");

						cart_name.push( $(elem).attr("data-item-name") );
						cart_desc.push( itemdesc );
						refresh_cart_container();
                    }
                }
           // }
        }

		$(document).on("keyup change",".min_qty_validation", function(event){
			var input_val = parseInt($(this).val());
			var min_val = parseInt($(this).attr("min"));

			console.log("input_val", input_val);

			if(input_val<min_val || isNaN(input_val))
			{
				$(this).css("border-color","red");
				$(this).parent().find("button").attr("disabled", true);
				//$(this).parent().find("a.add_cart_group").attr("disabled", true);
			}else{
				$(this).css("border-color","");
				$(this).parent().find("button").attr("disabled", false);
				//$(this).parent().find("a.add_cart_group").attr("disabled", false);
			}
		});

		$(document).on("click", ".remove_item_cart", function(event){

			var item_id = $(this).parents(".row:first").attr("item_id");
			var index = $(this).parents(".row:first").index();
			sessionStorage.removeItem("image_"+item_id+"_"+index);

			cart_name.splice($(this).attr("index"), 1);
			cart_desc.splice($(this).attr("index"), 1);

			cart.splice($(this).attr("index"), 1);
			product_for_shirt.splice($(this).attr("index"), 1);

			refresh_cart_container();
			if(cart.length==0 )
			{
				$(".cart_container_new").toggle();
				$("#myCarousel").toggle();
				$(".banner").toggle();
				$("#products_container_selected").toggle();
			}
			//updatecarttotalprice();
		});

		window.loadone = 0;
		function refresh_cart_container()
		{
			$(".summary_loader").show();
			//console.log(cart);
			//console.log(cart_name);
			var sum = 0;
			var html = "";
			var html2 = "";
			$.each(cart, function(index, value){

				if(value["isprintful"] !== undefined)
				{
					console.log("printful product");
					html +=`<div class="row my-4" item_id="`+value["id"]+`">
							<div class="col-md-2 picture">
							<img class="card-img-top  w-100" src="`+value['image']+`" alt="Card image cap" style="height: auto;width: 150px;">
							</div>
							<div class="col-md-6 picture">
								<h2>`+cart_name[index]+`</h2>
								<div class="row my-3">
									<div class="col-md-6"><span class="h5">Size: </span><span>`+value['size']+`</span></div>
									<div class="col-md-6 text-right"><span class="h5">Color: </span><span> <input type="checkbox" class="checkbox-round_disable" style="background-color:`+value['color_code']+`;" /></span></div>
								</div>
								<!--<h5 style="font-weight: 400;">`+cart_desc[index]+`</h5>-->
								<div class="col-md-12 p-0">
									<span class="remove_item_cart h5" index="`+index+`" style="color:red; cursor:pointer;">Remove</span>
									<input type="text" value="`+value['quantity']+`" class="form-control quantity_input" style="width: 50px;float: right;margin-top: -12px;">
									<span class="h5" style="float: right;">qty: </span>
								</div>
							</div>
							<div class="col-md-4 picture text-center"> <h1>$ <span class="p_rate">`+value['total_product_price']+`</span></h1> </div>
						</div>`;

						html2 += `<div class="row my-4">
								<div class="col-md-3 picture">
								<img class="card-img-top  w-100" src="`+value['image']+`" alt="Card image cap" style="height: auto;width: 150px;">
								</div>
								<div class="col-md-9 picture">
									<h4>`+cart_name[index]+`</h4>
									<div class="row my-3">
										<div class="col-md-6"><span class="h5">Size: </span><span>`+value['size']+`</span></div>
										<div class="col-md-6 text-right"><span class="h5">Color: </span><span> <input type="checkbox" class="checkbox-round_disable" style="background-color:`+value['color_code']+`;" /></span></div>
									</div>
									<!--<p>`+cart_desc[index]+`</p>-->
									<div class="row">
										<div style="" class="col-md-12 text-right">qty: `+value['quantity']+`</div>
									</div>
								</div>
							</div>`;
					sum += value['total_product_price']*value['quantity'];

				}else{
					html +=`<div class="row my-4" item_id="`+value["item_id"]+`">
							<div class="col-md-2 picture">
							<img class="card-img-top  w-100" src="`+value['item_custom_fields'][0]['value']+`" alt="Card image cap" style="height: auto;width: 150px;">
							</div>
							<div class="col-md-6 picture">
								<h2>`+cart_name[index]+`</h2>
								<h5 style="font-weight: 400;">`+cart_desc[index]+`</h5>
								<div class="col-md-12 p-0">
									<span class="remove_item_cart h5" index="`+index+`" style="color:red; cursor:pointer;">Remove</span>
									<input type="text" value="`+value['quantity']+`" class="form-control quantity_input" style="width: 50px;float: right;margin-top: -12px;">
									<span class="h5" style="float: right;">qty: </span>
								</div>
							</div>
							<div class="col-md-4 picture text-center"> <h1>$ <span class="p_rate">`+value['rate']+`</span></h1> </div>
						</div>`;

					html2 += `<div class="row my-4">
								<div class="col-md-3 picture">
								<img class="card-img-top  w-100" src="`+value['item_custom_fields'][0]['value']+`" alt="Card image cap" style="height: auto;width: 150px;">
								</div>
								<div class="col-md-9 picture">
									<h4>`+cart_name[index]+`</h4>
									<p>`+cart_desc[index]+`</p>
									<div class="col-md-12 p-0">
										<span style="float: right;">qty: `+value['quantity']+`</span>
									</div>
								</div>
							</div>`;
					sum += value['rate']*value['quantity'];
				}
			});

			$("#shopping_cart_items").html(html);
			$(".checkout_items").html(html2);
			$(".summary_loader").hide();

			total = sum;
			$(".shopping_cart_price").text(Math.round(sum));
            $(".badge-number").text(cart.length);

			var address = "";
			@if( isset($googleuser) )
				address = @json($googleuser->address);
			@endif

			//call ajax to get shipping rate and tax rate
			$.ajax({
				type: "POST",
				data: {
					cart: cart,
					product_for_shirt: product_for_shirt,
					cart_name: cart_name,
					cart_desc: cart_desc,
					store: @json($store),
					address: address, //}}}".replace(/&quot;/g,'"'),
					_token: _token,
				},
				url: '{{$domain_name}}/getShippingrateTaxrate',
				async: false,
				success: function(data) {
					console.log(data);
					//Order Summary

					if(data==0)
					{
						$(".shipping_rate").text(0);
						$(".tax_rate").text(0);
						total += parseFloat(0);

						$(".delivery_days").text("-");
					}else{
						$(".shipping_rate").text(data.rate);
						$(".tax_rate").text(data.tax['rate']);
						total += parseFloat(data.rate) + parseFloat(data.tax['rate']);

						$(".delivery_days").text("Delivers in "+data.minDeliveryDays+"-"+data.maxDeliveryDays+" Days");
					}

						//$(".shipping_rate").text(data.rate);
						//total += parseFloat(data.rate);

						console.log("total", total);
						if(total==0)
						{
							$(".net_amount").attr( "val", Math.ceil(1*100) );
							items[0]['price'] = Math.ceil(1*100);
							$(".shopping_cart_total").text("0");
						}else{
							$(".net_amount").attr( "val", Math.ceil(total*100) );
							items[0]['price'] = Math.ceil(total*100);
							$(".shopping_cart_total").text( total.toFixed() );
						}

						//strip checkout refresh
						loadone++;
						if(loadone>1)
						{
							//reinitialize_stripe();

							// // let ss_p = document.getElementById("ss_val").value;
							// // window.stripe = Stripe(ss_p);
							// // window.items = [{ price: $(".net_amount").attr("val")  }];
							// // let elements;


							// $.ajax({
							// 	type: "POST",
							// 	data: {
							// 		_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
							// 		body: JSON.stringify({ items }),
							// 	},
							// 	url: "checkout_create_php",
							// 	async: false,
							// 	dataType: 'json',
							// 	success: function(data) {
							// 		const { clientSecret } = data;
							// 		elements = stripe.elements({ clientSecret, appearance});

							// 		const paymentElement = elements.create("payment");
							// 		paymentElement.mount("#payment-element");

							// 	},
							// 	error: function(Data) {
							// 		alertify.error("Error to init")
							// 		console.log(Data)
							// 	}
							// });
						}
				}
			});

			//save cart into session
			$.ajax({
				type: "POST",
				data: {
					cart: cart,
					product_for_shirt: product_for_shirt,
					cart_name: cart_name,
					cart_desc: cart_desc,
					store: @json($store),
					_token: _token,
				},
				url: '{{$domain_name}}/savecartintosession',
				async: false,
				success: function(data) {
					//console.log(data);
					//location.reload();
				}
			});
		}


        function additemtocart2(elem) {

			var flag = false;
			$(".userdefine_fields[required]:visible").each(function(index, value){
				//console.log("value", value);
                if( $(value).val()=="" )
                {
                    alertify.error("Please fill the required fields");
					flag = true;
					return false;
                }
			});
			if(flag){
				return false;
			}

            quantity = parseInt(
                document.getElementById(elem.getAttribute("data-item-id")).value
            )
			itemid = elem.getAttribute("data-item-id")
			itemimage= elem.getAttribute("data-item-image")



            rate = elem.getAttribute("data-item-rate")
			//item_shirtsize = elem.getAttribute("data-item-shirt")


			var item_shirtsize = document.getElementById(elem.getAttribute("data-item-shirt"));
            var item_mon_fri = document.getElementById(elem.getAttribute("data-item-mon-fri"));
			var item_sat = document.getElementById(elem.getAttribute("data-item-sat"));
			var item_sun = document.getElementById(elem.getAttribute("data-item-sun"));
			var item_moq = document.getElementById(elem.getAttribute("data-item-moq"));

			if(item_shirtsize != null){
				var shirt_size = item_shirtsize.value;

			}


			if(item_mon_fri != null){
				var mon_fri = item_mon_fri.value;
			}

			if(item_sat != null){
				var sat = item_sat.value;
			}

			if(item_sun != null){
				var sun = item_sun.value;
			}

			if(item_moq != null){
				var unit = item_moq.value;
			}

            sum = rate * quantity;
            check = sum + total;

            if (check > limit) {
                alertify.error("Not enough Funds");
            } else {
				if (quantity > 0) {
				cart.push({
					"item_id": itemid,
					"quantity": quantity,
					"rate": rate,
					"unit": "qty",
					"item_custom_fields": [
                        {
                        "api_name": "cf_proof_url",
                        "placeholder": "cf_proof_url",
                        "value":  itemimage
                    }
               		 ]
				})
				product_for_shirt.push({
				"Apparel_Size": shirt_size,
				"Unit_Label" : unit,
				"Mon_Fri" : mon_fri,
				"Sat" : sat,
				"Sun" : sun
				});

				$(".userdefine_fields:visible").each(function(index, value){
					if(value.type == 'file'){
						var fieldName = value.name;
						var file_data = $('input[name='+fieldName+']').prop("files")[0];

						i++;
						fd.append("image"+i, file_data);
						fd.append("index", i);

					}else{
						product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = $(value).val();
					}
				});


				sum = rate * quantity;
				total += sum
				document.getElementById("total").innerText = "Total: " + Math.round(total) + "$";
				alertify.success("Product added to cart");
				$(".modal").modal("hide");

				cart_name.push( $(elem).attr("data-item-name") );
				//cart_desc.push();
				refresh_cart_container();
				}
				else{
					alertify.error("Quantity can not be 0");
				}
            }


        }

     function additemtocartgroup(elem) {
			var unit_label = document.getElementById(elem.getAttribute("data-item-unit"));
			var mon_fri_label = document.getElementById(elem.getAttribute("data-item-mon-fri"));
			var sat_label = document.getElementById(elem.getAttribute("data-item-sat"));
			var sun_label = document.getElementById(elem.getAttribute("data-item-sun"));


			if (mon_fri_label != null) {
				mon_fri = mon_fri_label.value;
			}
			else {
			mon_fri = null;
			}

			if (sat_label != null) {
				sat = sat_label.value;
			}
			else {
			sat = null;
			}

			if (sun_label != null) {
				sun = sun_label.value;
			}
			else {
			sun = null;
			}

			if (unit_label != null) {
				unit = unit_label.value;
			}

			else {
			unit = null;
			}

			if(unit == ""){
					alertify.error("Require Unit Label Field");
			}
			else{
			min_value = parseInt(
                document.getElementById(elem.getAttribute("data-item-id")).min
			)

			quantity = parseInt(
                document.getElementById(elem.getAttribute("data-item-id")).value
			)

			var name = elem.getAttribute('name');
			var ele = document.getElementsByName(name);

            for(ia = 0; ia < ele.length; ia++) {
                if(ele[ia].checked)
				var color = ele[ia].value;
            }
			if(color){
				var item_color = color ;

			}else{
				alert('Please Select Qty');
				return false;
			}

			var flag = false;
			$(".userdefine_fields[required]:visible").each(function(index, value){
				if( $(value).val()=="" )
                {
                    alertify.error("Please fill the required fields");
					flag = true;
					return false;
                }
			});
			if(flag){
				return false;
			}

			group_id = elem.getAttribute("data-item-id");
			var data_group_index = elem.getAttribute("data-group-index");
			var selected_item_id = $(".size_value:visible option:selected").attr("data-item-id");
			if(typeof selected_item_id=="undefined")
			{
				selected_item_id = $("input.radio_box[name='color"+group_id+"']:checked").attr("data-item-id");
			}
		   var size = $(".attr_size"+group_id+"").val();
			if(size){
				var item_size = size ;
				if(item_size){
					var size_group_item = item_size;
				}
				else{
					alert('Please Select Size');
				}
			}
			var rate =   $(".current-price"+group_id+"").text();
			sum = rate * quantity;

				if(min_value > quantity){
					alertify.error("Quantity Not Less Then "+ min_value +"");
						}
					else{
						$.each(item_groups[data_group_index]['items'], function(index, value){
							if(value['item_id'] == selected_item_id)
							{
								//console.log("desc", item_groups[data_group_index]['description']);
								selected_rate = value['rate'];
								selected_item_name = value['name'];
								selected_item_description = item_groups[data_group_index]['description'];
								selected_item_image = "https://dashboard.blinkswag.com/storage/app/ItemImages/"+selected_item_id+"."+value['image_type'];
							}
						});

							if (quantity > 0) {

								incart = 0;
								cart.forEach((elem) => {
									if (elem["item_id"] == selected_item_id) {
										incart = parseInt(elem["quantity"])
									}
								})
								if (incart > 0) {
									final_qty = incart + quantity
									cart.forEach((elem) => {
										if (elem['item_id'] == selected_item_id) {
											elem['quantity'] = final_qty;
										}
									})
									alertify.success("Product added to cart");
									sum = rate * quantity;
									total += sum
									$(".modal").modal("hide");
									refresh_cart_container();
								}else{
									cart.push({
									"item_id": selected_item_id,
									"quantity": quantity,
									"rate": selected_rate,
									"unit": "qty" ,
									"item_custom_fields": [
										{
										"api_name": "cf_proof_url",
										"placeholder": "cf_proof_url",
										"value": selected_item_image
									}
								]

								})
								product_for_shirt.push({
								"Unit_Label" : unit,
								"Mon_Fri" : mon_fri,
								"Sat" : sat,
								"Sun" : sun
								})

								$(".userdefine_fields:visible").each(function(index, value){
									if(value.type == 'file'){
										var fieldName = value.name;
										var file_data = $('input[name="'+fieldName+'"]').prop("files")[0];
										i++;
										fd.append("image"+i, file_data);
										fd.append("index", i);
									}else{
										product_for_shirt[product_for_shirt.length-1][$(value).attr('name')] = $(value).val();
									}
								});
								sum = selected_rate * quantity;
								total += sum
								document.getElementById("total").innerText = "Total: " + Math.round(total) + "$";
								alertify.success("Product added to cart");
								$(".modal").modal("hide");
								}
							}
				}
		}
		cart_name.push( $(elem).attr("data-item-name") );
		cart_desc.push( selected_item_description );
			refresh_cart_container();
	}


   window.item_groups = @json($item_groups);
function changeImage(elem){
			//$(".loader").show();
			var color_id = elem.getAttribute("color-item-id");
		    var data_group_id = elem.getAttribute("data-group");
		    //var size = $('.size_value').val();
			var size = $(".attr_size"+data_group_id+"").val();

			//console.log("size", size);

			var data_group_index = $(elem).attr("data-group-index");
			var data_item_index = $(elem).attr("data-item-index");
			//console.log( item_groups[data_group_index]['items'][data_item_index] );
			if( item_groups[data_group_index]['attribute_name1'] )
			{
				var item_image = "";
				var rate = "";
				var validation_quantity = 1;
				$.each( item_groups[data_group_index]['items'], function(index, value){
					//console.log( value['attribute_option_id1'], value['attribute_option_id2'] );
					if( typeof size != "undefined")
					{
						if( value['attribute_option_id1']==color_id  && size == value['attribute_option_id2']  )
						{
							rate = value['rate'];
							validation_quantity = value['reorder_level'];
							console.log("validation_quantity", validation_quantity);
							if(validation_quantity=="")
							{
								validation_quantity = 1;
							}
							//var description = value['description'];
							//console.log(rate);


							var unit = "";
							if( value['cf_unit_label'] ){
								unit = value['cf_unit_label'];
							}

							var moq_number  = 1;
							if( value['cf_moq'] ){
								moq = value['cf_moq'];
								moq_arr = moq.split(',');
								moq_number = moq_arr[0];
							}

							var cf_mon_fri = "";
							if(value['cf_mon_fri']){
								cf_mon_fri = "<span class='control-label'>Mon - Fri </span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_mon_fri']+"'  id='mon_fri"+value['group_id']+"' required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							var cf_saturday = "";
							if(value['cf_saturday']){
								cf_saturday = "<span class='control-label'>Sat</span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_saturday']+"' id='sat"+value['group_id']+"' name='unit'  required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							var cf_sunday = "";
							if(value['cf_sunday']){
								cf_sunday = "<span class='control-label'>Sat</span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_sunday']+"'  id='sun"+value['group_id']+"' name='unit'  required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							item_image = "https://dashboard.blinkswag.com/storage/app/ItemImages/"+value['item_id']+"."+value['image_type'];

						}
					}else{
						if(value['attribute_option_id1']==color_id)
						{
							rate = value['rate'];
							validation_quantity = value['reorder_level'];
							if(validation_quantity=="")
							{
								validation_quantity = 1;
							}

							console.log("validation_quantity", validation_quantity);
							//var description = value['description'];
							//console.log(rate);


							var unit = "";
							if( value['cf_unit_label'] ){
								unit = value['cf_unit_label'];
							}

							var moq_number  = 1;
							if( value['cf_moq'] ){
								moq = value['cf_moq'];
								moq_arr = moq.split(',');
								moq_number = moq_arr[0];
							}

							var cf_mon_fri = "";
							if(value['cf_mon_fri']){
								cf_mon_fri = "<span class='control-label'>Mon - Fri </span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_mon_fri']+"'  id='mon_fri"+value['group_id']+"' required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							var cf_saturday = "";
							if(value['cf_saturday']){
								cf_saturday = "<span class='control-label'>Sat</span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_saturday']+"' id='sat"+value['group_id']+"' name='unit'  required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							var cf_sunday = "";
							if(value['cf_sunday']){
								cf_sunday = "<span class='control-label'>Sat</span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='text'  value='"+value['cf_sunday']+"'  id='sun"+value['group_id']+"' name='unit'  required='required'  class='input-group form-control unit'  style='display: block'></div></div>";
							}

							item_image = "https://dashboard.blinkswag.com/storage/app/ItemImages/"+value['item_id']+"."+value['image_type'];

						}
					}
				});
				$(".product-cover"+data_group_id+"").html("<img class='card-img-top' src="+item_image+">");
				$(".current-price"+data_group_id+"").html(rate);

				$(".qty"+data_group_id+"").find(".product_qty").attr("min", validation_quantity);
				$(".qty"+data_group_id+"").find(".product_qty").val(validation_quantity);
				$(".qty"+data_group_id+"").find(".product_qty").css("border-color","");
				//$(".qty"+data_group_id+"").find("a.add_cart_group").attr("disabled", false);
				$('button[name="color'+data_group_id+'"]').attr("disabled", false);

				$(".qty"+data_group_id+"").parent().next().html("This item has minimum order quantity of "+validation_quantity+".");

			}
}


$(document).ready(function() {

	$(".cart_header").on("click",function(event){
		if(cart.length==0)
		{
			alertify.error("Cart is empty");
			return false;
		}
		$(".cart_container_new").show();
		$("#myCarousel").hide();
		$(".banner").hide();
		$("#products_container_selected").hide();
		$(".checkout_container").hide();
	});
	$(".backtoshopping").on("click",function(event){
		$(".cart_container_new").hide();
		$("#myCarousel").show();
		$(".banner").show();
		$("#products_container_selected").show();
		$(".checkout_container").hide();
	});


	$('.size_value').on('change',function() {
		var attribute_size_id = this.value;
		var size_attribute = $(this).attr("data-id");
		var data_index = $(this).attr("data-index");
		var item_id = $("option:selected", this).attr("data-item-id");
		var data_item_index = $("option:selected", this).attr("data-index");

		var toAppend = '';
		var count = 0;

		if(attribute_size_id=="")
		{
			$(".color_attribute"+size_attribute+"").hide();
			$(".color_attribute_inner"+size_attribute+"").html(toAppend);
			return false;
		}

		$.each( item_groups[data_index]['items'], function(index, value){
			//console.log( value['attribute_option_id1'], value['attribute_option_id2'], value['attribute_option_name1'] );
			//if( value['attribute_option_id2']==attribute_size_id && value['stock_on_hand'] > 0 )
			if( value['attribute_option_id2']==attribute_size_id )
			{
				//toAppend +=  "<li style='float:left'><label><input type='radio' class='color"+count+"' data-id='"+size_attribute+"' data-item-id='"+value['item_id']+"' data-group='"+size_attribute+"' onclick='changeImage(this)' data-id="+value['attribute_option_id1']+"   id="+value['attribute_option_id1']+" name='color"+size_attribute+"' color-item-id="+value['attribute_option_id1']+" value="+value['attribute_option_id1']+"><span style='margin-left:4px' class='color'>"+value['attribute_option_name1']+"</span></li>";
				toAppend +=  "<li style='float:left'><label><input type='radio' class='color"+count+"' data-group-index='"+data_index+"' data-item-index='"+index+"' data-item-id='"+value['item_id']+"' data-group='"+size_attribute+"' onclick='changeImage(this)' data-id="+value['attribute_option_id1']+"   id="+value['attribute_option_id1']+" name='color"+size_attribute+"' color-item-id="+value['attribute_option_id1']+" value="+value['attribute_option_id1']+"><span style='margin-left:4px' class='color'>"+value['attribute_option_name1']+"</span></li>";
				count++;
			}
		});
		$(".color_attribute"+size_attribute+"").show();
		$(".color_attribute_inner"+size_attribute+"").html(toAppend);


		$(".description").html(item_groups[data_index]['description']);
		$(".current-price"+size_attribute+"").html( item_groups[data_index]['items'][data_item_index]['rate'] );
		$('.color0').prop('checked', true);
		//$(".color_attribute"+size_attribute+"").find('.color0').prop('checked', true).trigger("click");

		var singleItemtype =  item_groups[data_index]['items'][data_item_index]['image_type'];
		var image_src = 'https://dashboard.blinkswag.com/storage/app/ItemImages/'+item_id+"."+singleItemtype;
		$(".product-cover"+size_attribute+"").html("<img style='width: 100% !important;height: auto;' src="+image_src+">");
	});

	//quantity
	$(document).on("blur", ".quantity_input", function(){
		var qty = $(this).val();
		if( qty!="" )
		{
			$(".summary_loader").show();
			var index = $(this).parents(".row:first").index();
			cart[index]['quantity'] = parseInt(qty);
			refresh_cart_container();
		}
	});
	$(document).on("click", ".goto_checkout", function(){
		$(".cart_container_new").hide();
		$("#myCarousel").hide();
		$(".banner").hide();
		$("#products_container_selected").hide();

		$(".checkout_container").show();
		$("#form_container").hide();
	});
	$(".backtocart").on("click",function(event){
		$(".cart_container_new").show();
		$("#myCarousel").hide();
		$(".banner").hide();
		$("#products_container_selected").hide();
		$(".checkout_container").hide();
	});

	$(document).on("click",".loginwithgoogle", function(){
		console.log(cart);
		console.log(product_for_shirt);
		var store_name = '{{$store->name}}';
		var id_company = '{{$store->id_company}}';
		var id_category = '{{ $store->id_category }}';
		//{{env("APP_URL")}}/auth/redirect/{{$store->name}}
		console.log("click");
		$.ajax({
				type: "POST",
				data: {
					cart: cart,
					product_for_shirt: product_for_shirt,
					cart_name: cart_name,
					cart_desc: cart_desc,
					store: @json($store),
					_token: _token,
				},
				url: '{{$domain_name}}/savecartintosession',
				async: false,
				success: function(data) {
					console.log(data);
					//form submit
					window.location = '{{env("APP_URL")}}/auth/redirect/'+data;
				}
			});

		//var fd = new FormData();

	});

	$(document).on("click",".signup", function(){
		$(".login_form").hide();
		$(".signup_form").show();
		$(".forget_password_form").hide();
	});
	$(document).on("click",".signin", function(){
		$(".login_form").show();
		$(".signup_form").hide();
		$(".forget_password_form").hide();
	});
	$(document).on("click",".forget_password", function(){
		$(".login_form").hide();
		$(".signup_form").hide();
		$(".forget_password_form").show();
	});

	$(document).on("click",".submit_login", function(){
		var email = $(".login_form").find(".email:first").val();
		var password = $(".login_form").find(".password:first").val();
		if(email == "" || password == "")
		{
			alertify.error("Please fill the fields.");
			return false;
		}

		$.ajax({
			type: "POST",
			data: {
				email: email,
				password: password,
				_token: _token,
			},
			url: '{{$domain_name}}/storeUserLogin',
			async: false,
			success: function(data) {
				console.log(data);
				data = JSON.parse(data);
				if(data.status=="error")
				{
					alertify.error("Invalid Username and Password.");
					return false;
				}else{
					alertify.success("Login success.");
					console.log("data", data);
					location.reload();

					// $.ajax({
					// 	type: "POST",
					// 	data: {
					// 		cart: cart,
					// 		product_for_shirt: product_for_shirt,
					// 		cart_name: cart_name,
					// 		cart_desc: cart_desc,
					// 		store: @json($store),
					// 		_token: _token,
					// 	},
					// 	url: '{{$domain_name}}/savecartintosession',
					// 	async: false,
					// 	success: function(data) {
					// 		console.log(data);
					// 		//form submit
					// 		window.location = '{{env("APP_URL")}}/auth/redirect/'+data;
					// 	}
					// });
				}
			}
		});

	});
	$(document).on("click",".submit_signup", function(){
		var name = $(".signup_form").find(".name:first").val();
		var email = $(".signup_form").find(".email:first").val();
		var password = $(".signup_form").find(".password:first").val();
		var re_password = $(".signup_form").find(".re_password:first").val();

		var store_name = '{{$store->name}}';

		if(email == "" || password == "" || re_password == "" || name=="")
		{
			alertify.error("Please fill the fields.");
			return false;
		}
		if( !ValidateEmail(email) )
		{
			alertify.error("Email is invalid.");
			return false;
		}
		if( password!=re_password)
		{
			alertify.error("Passwords are not match.");
			return false;
		}

		$(".loader").show();
		$.ajax({
			type: "POST",
			data: {
				name: name,
				email: email,
				password: password,
				re_password: re_password,
				store_name: store_name,
				_token: _token,
			},
			url: '{{$domain_name}}/userstore_signup',
			async: false,
			success: function(data) {
				$(".loader").hide();
				console.log(data);
				data = JSON.parse(data);
				if(data.status=="error")
				{
					alertify.error(data.message);
					return false;
				}

				$.ajax({
					type: "POST",
					data: {
						cart: cart,
						product_for_shirt: product_for_shirt,
						cart_name: cart_name,
						cart_desc: cart_desc,
						store: @json($store),
						_token: _token,
					},
					url: '{{$domain_name}}/savecartintosession',
					async: false,
					success: function(data) {
						console.log(data);
						location.reload();
					}
				});

			}
		});
	});
	$(document).on("click",".submit_forget_password", function(){
		var email = $(".forget_password_form").find(".email:first").val();
		if(email == "")
		{
			alertify.error("Please enter email.");
			return false;
		}
		console.log("email", email);
		$.ajax({
				type: "POST",
				data: {
					email: email,
					_token: _token,
				},
				url: '{{$domain_name}}/forgetPassword',
				async: false,
				success: function(data) {
					data = JSON.parse(data);
					console.log(data);
					if(data.status=='error')
					{
						alertify.error(data.message);
					}else{
						$(".email").val("");
						alertify.success(data.message);
					}
					return false;
					//if(data[error])
					//location.reload();
				}
			});





	});

	$(document).on("keyup",".password,.re_password", function(){
		var password = $(".signup_form").find(".password:first").val();
		var re_password = $(".signup_form").find(".re_password:first").val();
		if(password==re_password)
		{
			$(".signup_form").find(".password:first").css("border", "1px solid #ccc");
			$(".signup_form").find(".re_password:first").css("border", "1px solid #ccc");
		}else{
			$(".signup_form").find(".password:first").css("border", "1px solid red");
			$(".signup_form").find(".re_password:first").css("border", "1px solid red");
		}
	});

	$(document).on("click",".saveaddress", function(){
		//alert("click");
		var email 		= $("#email").val();
		var address 	= $("#address").val();
		var city 		= $("#cityId").val();
		var street2 	= $("#street2").val();
		var state 		= $("#gds-cr-one").val();
		var zip 		= $("#zip").val();
		var country 	= $("#countryId").val();
		var country_code 	= $("#countryId option:selected").attr("data-class");
		var attention 	= $("#full_name").val();

		if(
			attention == "" ||
			email == "" ||
			address == "" ||
			zip == "" ||
			country == "" ||
			state == "" ||
			city == ""
		){
			alertify.error("Please fill the required fields.");
			return false;
		}
		if (street2 == "null") {
			street2 = "";
		}
		var address_array = {
			"address": address,
			"city": city,
			"street2": street2,
			"state": state,
			"zip": zip,
			"country": country,
			"country_code": country_code,
			"attention": attention
		};
		$.ajax({
					type: "POST",
					data: {
						address_array: JSON.stringify(address_array),
						storeuserid: $("#googleuserid").val(),
						_token: _token,
					},
					url: '{{$domain_name}}/storeuseraddress',
					async: false,
					success: function(data) {
						//console.log(data);
						alertify.success("Address has been saved.");
						//call ajax to get shipping rate and tax rate
						$.ajax({
							type: "POST",
							data: {
								cart: cart,
								product_for_shirt: product_for_shirt,
								cart_name: cart_name,
								cart_desc: cart_desc,
								store: @json($store),
								address: JSON.stringify(address_array),
								_token: _token,
							},
							url: '{{$domain_name}}/getShippingrateTaxrate',
							async: false,
							success: function(data) {
								console.log(data);
								//Order Summary
								$(".shipping_rate").text(data.rate);
								$(".tax_rate").text(data.tax['rate']);
								total += parseFloat(data.rate) + parseFloat(data.tax['rate']);
								$(".delivery_days").text("Delivers in "+data.minDeliveryDays+"-"+data.maxDeliveryDays+" Days");

								//total += parseFloat(data.rate);
								console.log("total", total);
								if(total==0)
								{
									$(".net_amount").attr( "val", Math.ceil(1*100) );
									items[0]['price'] = Math.ceil(1*100);
									$(".shopping_cart_total").text("0");
								}else{
									$(".net_amount").attr( "val", Math.ceil(total*100) );
									items[0]['price'] = Math.ceil(total*100);
									$(".shopping_cart_total").text( total.toFixed() );
								}

								//strip checkout refresh
								loadone++;
								if(loadone>1)
								{
									$.ajax({
										type: "POST",
										data: {
											_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
											body: JSON.stringify({ items }),
										},
										url: "checkout_create_php",
										async: false,
										dataType: 'json',
										success: function(data) {
											const { clientSecret } = data;
											elements = stripe.elements({ clientSecret, appearance});

											const paymentElement = elements.create("payment");
											paymentElement.mount("#payment-element");

										},
										error: function(Data) {
											alertify.error("Error to init")
											console.log(Data)
										}
									});
								}
							}
						});
					}
				});



	});

	$(document).on("click",".logoutlabel", function(){
		$.ajax({
			type: "POST",
			data: {
				storeuserid: $("#googleuserid").val(),
				_token: _token,
			},
			url: '{{$domain_name}}/storeUserLogout',
			async: false,
			success: function(data) {
				console.log(data);
				alertify.success("You have successfully logout.");
				location.reload();
			}
		});
	});

	$(document).on("click",".gallery_left", function(){
        $(".gallery_left.active").removeClass("active");
        $(this).addClass("active");

        var img_src = $(this).find("img:first").attr("src");
        $("img.modal_product_image").attr("src",img_src);
    });
 }); //end ready function

 function Checkout_new()
	{
		var full_name 	= $("#full_name").val();
		var email 		= $("#email").val();
		var address 	= $("#address").val();
		var street2 	= $("#street2").val();
		var zip 		= $("#zip").val();
		var countryId 	= $("#countryId").val();
		var state 		= $("#gds-cr-one").val();
		var cityId 		= $("#cityId").val();

		if(
			full_name == "" ||
			email == "" ||
			address == "" ||
			zip == "" ||
			countryId == "" ||
			state == "" ||
			cityId == ""
		){
			alertify.error("Please fill the required fields and save.");
			return false;
		}

		$(".cart_container_new").hide();
		$("#myCarousel").hide();
		$(".banner").hide();
		$("#products_container_selected").hide();
		$(".checkout_container").hide();

		reinitialize_stripe();

		$("#form_container").show();
	}

	//https://www.w3resource.com/javascript/form/email-validation.php
	function ValidateEmail(input) {
		var validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (input.match(validRegex)) {
			return true;
		} else {
			return false;
		}
	}

	function reinitialize_stripe()
	{
		//alert('test');
		console.log( $(".net_amount").attr("val") );
		let ss_p = document.getElementById("ss_val").value;
		window.stripe = Stripe(ss_p);

		window.items = [{ price: $(".net_amount").attr("val")  }];

		let elements;

		window.appearance = {
			theme: 'stripe',

			variables: {
			colorPrimary: '#0570de',
			colorBackground: '#ffffff',
			colorText: '#7f7f7f',
			colorDanger: '#df1b41',
			fontFamily: 'Ideal Sans, system-ui, sans-serif',
			// spacingUnit: '2px',
			// borderRadius: '4px',
			// See all possible variables below
			}
		};

		initialize();
		checkStatus();
		document.querySelector("#payment-form").addEventListener("submit", handleSubmit);
		async function initialize() {
			$.ajax({
				type: "POST",
				data: {
					_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
					body: JSON.stringify({ items }),
				},
				url: "checkout_create_php",
				async: false,
				dataType: 'json',
				success: function(data) {
					const { clientSecret } = data;
					elements = stripe.elements({ clientSecret, appearance});

					const paymentElement = elements.create("payment");
					paymentElement.mount("#payment-element");

				},
				error: function(Data) {
					alertify.error("Error to init")
					console.log(Data)
				}
			});
		}

		async function handleSubmit(e) {
			e.preventDefault();
			setLoading(true);

			const { error } = await stripe.confirmPayment({
			elements,
			confirmParams: {
			return_url: "http://localhost/dashboard/store_order",
			},
			}).then(function(result) {
			if (result.error) {
			}
			});

			if (error.type === "card_error" || error.type === "validation_error") {
			showMessage(error.message);
			} else {
			showMessage("An unexpected error occurred.");
			}

			setLoading(false);
		}

		// Fetches the payment intent status after payment submission
		async function checkStatus() {
			const clientSecret = new URLSearchParams(window.location.search).get(
			"payment_intent_client_secret"
			);

			if (!clientSecret) {
			return;
			}

			const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

			switch (paymentIntent.status) {
			case "succeeded":
				showMessage("Payment succeeded!");
				break;
			case "processing":
				showMessage("Your payment is processing.");
				break;
			case "requires_payment_method":
				showMessage("Your payment was not successful, please try again.");
				break;
			default:
				showMessage("Something went wrong.");
				break;
			}
		}
	}
	// ------- UI helpers -------

	function showMessage(messageText) {
		const messageContainer = document.querySelector("#payment-message");

		messageContainer.classList.remove("hidden");
		messageContainer.textContent = messageText;

		setTimeout(function () {
		messageContainer.classList.add("hidden");
		messageText.textContent = "";
		}, 4000);
	}

	// Show a spinner on payment submission
	function setLoading(isLoading) {
		if (isLoading) {
		// Disable the button and show a spinner
		document.querySelector("#submit").disabled = true;
		document.querySelector("#spinner").classList.remove("hidden");
		document.querySelector("#button-text").classList.add("hidden");
		} else {
		document.querySelector("#submit").disabled = false;
		document.querySelector("#spinner").classList.add("hidden");
		document.querySelector("#button-text").classList.remove("hidden");
		}
	}

window.items = [{ price: 0  }];
refresh_cart_container();
reinitialize_stripe();

</script>
	<!-- <script src="{{env('APP_URL')}}/public/assets/js/checkout_store.js" defer></script> -->
</html>
