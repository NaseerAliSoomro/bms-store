@extends('layouts.app')

@section('content')

@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
    $domain_name = "/blinkswag-dashboard";

    }

    @endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
    width: 165px;
    padding-top: 10px;
    padding-bottom: 10px;
}


h2.cat-heading {
    margin: 12px;
    font-size: 14px;
    margin-top: 36px;
    line-height: normal;
    margin-left: 24px;
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

ul.nav.nav-tabs.categories li i, a {
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
    position: fixed;
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


input[type='radio']{
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
}
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

</style>





<script>
$(document).ready(function(){
    $("#myTab a:first").tab("show"); // show last tab
    $(".tab-content tab-pane:first").tab("show"); // show last tab

});

</script>

<div id="overlay" style="display:none;">
 <img  src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" alt="" class="spinner1">
</div>



    <div class="row">

<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<div id="mySidenav" class="sidenav">
    <h2 class="cart-title">YOUR SWAG</h2>
    <hr/>
    <ul class="cart-products">

    </ul>
    <hr class="divider">
    <div class="cart-footer">
        <div class="total">
                <p class="total-estimate">Total estimate <svg class="MuiSvgIcon-root jss60" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg></p>
                <p class="total-num"></p>
        </div>
        <div class="text-center">
            <button type="button" class='active btn btn-default' id="addproject" onclick="addproject(this)">Next: Add project details</button>
        </div>
    </div>
</div>



        <div class="col-md-2 fixed-content">

            <h2 class="cat-heading">CATEGORIES</h2>
        <ul class="nav nav-tabs categories" id="myTab" role="tablist">
            @foreach($categories as $category)
            @if($category['parent_category_id'] == '1316483000062685097'  )
            <li class="nav-item ">
            <a   href="#customSection{{$category['category_id']}}" class="nav-link  nav_link navlink{{$category['category_id']}}" data-category-name="{{$category['name']}}" data-seq="{{$category['category_id']}}" data-toggle="tab" href="#tab-{{$category['category_id']}}" role="tab" aria-controls="home">{{$category['name']}}</a>
            </li>
            @endif
            @endforeach

        </ul>
        </div>
        <div class="col-md-7 project-append"></div>
        <div class="col-md-7 ml-220 code-append" >

        <div class="sections section{{$category_id}}" data-cat-id="{{$category_id}}" >
            <div class="content_heading">
            <h2>Start Your Custom Swag</h2>
            <p>Get started on designing your custom swag from our selection of curated picks in the hottest swag categories today. With individual items, you can skip the packaging (the 'pack') and just focus on the items you love. Choose from quality brands including North Face, Stickermule, Moleskine, and more. Then, add your swag project details (no credit card info required) to get your mockups!</p>
            <h3>First up, pick your <b class='change_category'>packaging!</b></h3>
            </div>





            @foreach($categories as $category)
                @if($category['parent_category_id'] == '1316483000062685097'  )

                    <div class="sections_custom section_custom{{$category['category_id']}}" data-cat-id="{{$category['category_id']}}" >
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-{{$category['category_id']}}" role="tabpanel">
                                <div class="row main-tab dev{{$category['category_id']}}" data-id="{{$category['category_id']}}">
                                    @foreach($items as $item)
                                        @if( $item['category_id'] == $category['category_id'] )
                                            @if (!array_key_exists('group_id', $item))

                                                <div class="col-md-4 " >
                                                    <div class="content-box">

                                                            <div class="item-image "  data-toggle="modal" data-target="#items{{$item['item_id']}}">
                                                                <img class="img-fluid" src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}">
                                                            </div>
                                                            <div class="item-title">
                                                                <p><strong>{{$item['name']}}</strong></p>
                                                            </div>
                                                            <input type="hidden" id="{{ $item['item_id'] }}"  value="50" min="50" class="form-control">

                                                            <!-- <div class="item-button img-change{{$item['item_id']}}"  data-item-quantity="{{$item['item_id']}}"  data-item-image-type="{{$item['image_type']}}"  data-item-id="{{$item['item_id']}}" data-item-name="{{$item['name']}}" data-item-rate="{{$item['rate']}}"	onclick="additemtocart(this)">
                                                            <img src="{{env('APP_URL') }}/public/assets/img/add-icon.png">
                                                            </div> -->
                                                            <div class="item-price">
                                                                <p>Starting at <strong>${{$item['rate']}}</strong></p>
                                                            </div>
                                                    </div>
                                                </div>

                                            @endif
                                        @endif
                                    @endforeach

                                    @foreach($itemsgroup as $groupitems)
                                        @foreach($groupitems as $groupitem)
                                            @if( $groupitem[0]['category_id'] == $category['category_id'] )
                                                <div class="col-md-4 " >
                                                    <div class="content-box " >
                                                        <div class="item-image" data-toggle="modal" data-target="#groupitems{{$groupitem[0]['group_id']}}" >
                                                                <img class="img-fluid" src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $groupitem[0]['item_id'] }}.{{ $groupitem[0]['image_type'] }}">
                                                            </div>
                                                            <div class="item-title">
                                                                <p><strong>{{$groupitem[0]['group_name']}}</strong></p>
                                                            </div>
                                                            <!-- <div class="item-button"  data-toggle="modal" data-target="#groupitems{{$groupitem[0]['group_id']}}">
                                                            <img src="{{env('APP_URL') }}/public/assets/img/eye-icon.png">
                                                            </div> -->
                                                            <div class="item-price">
                                                                <p>Starting at <strong>${{$groupitem[0]['rate']}}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    </div>
                @endif
            @endforeach

        </div>

        </div>
    </div>

    <div class="row"  id="scroll-hide" style="">
            <div class="form-group" id="scroll-to" ></div>
        </div>

	<!-- On Demand Model Box -->
    @foreach ($items as $item)
	<div class="modal fade demand" id="items{{$item['item_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog demand_items" role="document" style="max-width: 64rem;">
				<div class="modal-content">

				  <div class="modal-body" style="height:465px;overflow:auto">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
					<div class="row">
						<div class="col-md-6 single_image">
							<img class="card-img-top" src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}" onclick="previewImg(this)" alt="Card image cap" >

						</div>

						<div class="col-md-6 carousel_images" style="display: none;">
							<div id="carouselExampleControls{{$item['item_id']}}" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active">
									<img class="" src="..." alt="First slide">
									</div>
									<div class="carousel-item">
									<img class="" src="..." alt="Second slide">
									</div>
									<div class="carousel-item">
									<img class="" src="..." alt="Third slide">
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleControls{{$item['item_id']}}" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleControls{{$item['item_id']}}" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>

						<div class="col-md-6">
                            <span class="control-label" style="color:#000">Product Name
                                <input type="text" class="form-control item_name" value="{{$item['item_name']}}" />
                            </span>

                            <span class="control-label" style="color:#000">Description
                                <textarea class="form-control" col="10" rows="10">
                                    {{nl2br($item['description'])}}
                                </textarea>
                            </span>

                            <!-- <span class="control-label" style="color:#000">Minimum Quantity
                                <input type="number" id="{{ $item['item_id'] }}" value="50"  min="50" class="form-control">
                            </span> -->

                            <div class="product-prices" style="margin-top:20px">
                                <p style="color: #131415;font-weight:600;margin-bottom:0">Price/item</p>
                                <div class="current-price">
                                    <p style="color: #131415;font-weight:600;font-size: 28px;">
                                        <span class="dollarsign" style="position: absolute;font-size: 16px;padding: 10px;">$</span>
                                        <input type="text" class="form-control item_name" style="padding-left: 20px;" value="{{ $item['rate'] }}" />
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                <p style="color: #131415;font-weight:600;margin-bottom:0">Select Stores</p>
                                    <select multiple data-style="bg-white rounded-pill shadow-sm " class="selectpicker w-100 selected_stores">
                                        @foreach($stores as $store)
                                            <option>{{$store->name}}</option>
                                        @endforeach
                                    </select><!-- End -->
                                </div>
                            </div>

                            <div class="row col-md-5">
                                <div class="add">
                                <button class="btn btn-default img-change-btn{{$item['item_id']}}"
                                onclick="additemtocart(this)"   data-item-quantity="{{$item['item_id']}}" data-item-category="{{$item['category_id']}}"   data-item-rate="{{$item['rate']}}"	  data-item-image-type="{{$item['image_type']}}"  data-item-id="{{$item['item_id']}}" data-item-name="{{$item['name']}}"
                                style="font-size: 16px">Add</button>

                                </div>
                            </div>
						</div>
					</div>
				  </div>

				</div>
			  </div>
			</div>

	@endforeach


    @foreach($itemsgroup as $groupitems)

       @foreach($groupitems as $key => $groups)




<div class="modal fade my-items" id="groupitems{{$groups[0]['group_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog items" style="max-width: 64rem;" role="document">
        <div  id="model_container" class="modal-content ">

  <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
      <span aria-hidden="true">&times;</span>
    </button>
 <form id="frm">
  <div class="row">
    <div class="col-md-6 col-sm-6 hidden-xs-down single_image">
        <div class="images-container">
            @php $item_key = $loop->index;  @endphp

          <div class="product-cover{{$groups[0]['group_id']}}_{{$item_key}}"  >
          <img class="js-qv-product-cover card-img-top"
            src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $groups[0]['item_id'] }}.{{ $groups[0]['image_type'] }}"
            alt="Card image cap">
            <!-- @ if( $groups[0]['image_document_id']!="" )
            <img class="js-qv-product-cover card-img-top" src="https://inventory.zoho.com/DocTemplates_ItemImage_{{$groups[0]['image_document_id']}}.zbfs" alt="Card image cap"/>
            @ else
            <img class="card-img-top" src="{{env('APP_URL')}}/public/assets/img/browser.png" alt="Card image cap" />
            @ endif -->
        </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 hidden-xs-down carousel_images" style="display: none;">
        <div id="carouselExampleControls{{$groups[0]['group_id']}}" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="" src="..." alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls{{$groups[0]['group_id']}}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls{{$groups[0]['group_id']}}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="col-md-6 col-sm-6">
      <h1 class="contents{{$groups[0]['group_id']}}"> {{$groups[0]['group_name']}}</h1>

      @if($groups[0]['attribute_name1'] == 'Color')
      <p class="model-color-grey{{$groups[0]['group_id']}}_{{$item_key}}">{{$groups[0]['attribute_option_name1']}}</p>
      @endif

        <div class="product-actions" style="margin-bottom:20px">


            <div class="product-variants" style="padding-top:10px;">


                @if($groups[0]['attribute_option_name2'])

                <div class="clearfix product-variants-item">
                @if($groups[0]['attribute_name1'] == 'Color')
                    <strong class="control-label">Select {{$groups[0]['attribute_name1']}}</strong>

                    <ul id="color" style="list-style:none;padding:0;margin-top:10px">
                        @php
                        $newArray = array();
                        $usedcolor = array();
                        @endphp
                        @foreach ($groups as $key => $group)
                        @if ( !in_array($group['attribute_option_name1'], $usedcolor) )
                        @php
                        $usedcolor[] = $group['attribute_option_name1'];
                        $newArray[$key] = $group;
                        @endphp

                        @endif
                        @endforeach
                        @php
                        $result_groups = $newArray;
                        $newArray = NULL;
                        $usedFruits = NULL;
                        @endphp



                       @foreach ($result_groups as $key => $group)
                        @if($group['status'] == 'active')
                        @php
                        $colorname ;
                        $colortemp =  $group['attribute_option_name1'];
                        if(str_contains ($colortemp,'/')){
                            $colorname2 = explode('/',$group['attribute_option_name1']);
                            $colorname = $colorname2[0].' '.$colorname2[1];
                        }elseif(str_contains ($colortemp,'-')){
                            $colorname2 = explode('-',$group['attribute_option_name1']);
                            $colorname = $colorname2[0].' '.$colorname2[1];
                        }else{
                            $colorname =  $group['attribute_option_name1'];
                        }

                        @endphp
                        <li class="float-xs-left input-container">
                        <label>
                            <input type="radio" data-item-key="{{$item_key}}" data-item-category="{{$groups[0]['category_id']}}"  onclick="changeImage(this)" data-item-id="{{$group['item_id']}}"  data-group="{{$groups[0]['group_id']}}" data-id="{{$group['attribute_option_id1']}}" id="{{$group['attribute_option_id1']}}"  class="color{{$key}} radio_box {{ $colorname}} "   name="color{{$groups[0]['group_id']}}" color-item-id="{{$group['attribute_option_id1']}}" value="{{$group['attribute_option_id1']}}"  />
                            <span class="color"> </span>
                        </label>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                    </div>



            @else

                @if($groups[0]['attribute_option_name1'])

                  <div class="clearfix product-variants-item">
                  @if($groups[0]['attribute_name1'] == 'Color')
                    <strong class="control-label">Select {{$groups[0]['attribute_name1']}}</strong>

                    <ul id="color" style="list-style:none;padding:0;margin-top:10px">
                        @php
                        $newArray = array();
                        $usedcolor = array();
                        @endphp
                        @foreach ($groups as $key => $group)
                        @if ( !in_array($group['attribute_option_name1'], $usedcolor) )
                        @php
                        $usedcolor[] = $group['attribute_option_name1'];
                        $newArray[$key] = $group;
                        @endphp

                        @endif
                        @endforeach
                        @php
                        $result_groups = $newArray;
                        $newArray = NULL;
                        $usedFruits = NULL;
                        @endphp



                    @foreach ($result_groups as $key => $group)
                    @if($group['status'] == 'active')
                    @php
                        $colorname ;
                        $colortemp =  $group['attribute_option_name1'];
                        if(str_contains ($colortemp,'/')){
                            $colorname2 = explode('/',$group['attribute_option_name1']);
                            $colorname = $colorname2[0].' '.$colorname2[1];
                        }elseif(str_contains ($colortemp,'-')){
                            $colorname2 = explode('-',$group['attribute_option_name1']);
                            $colorname = $colorname2[0].' '.$colorname2[1];
                        }else{
                            $colorname =  $group['attribute_option_name1'];
                        }

                        @endphp

                    <li class="float-xs-left input-container">
                      <label>
                        <input type="radio" data-item-key="{{$item_key}}" data-item-category="{{$groups[0]['category_id']}}"  onclick="changeImage(this)" data-item-id="{{$group['item_id']}}"  data-group="{{$groups[0]['group_id']}}" data-id="{{$group['attribute_option_id1']}}" id="{{$group['attribute_option_id1']}}"  class="color{{$key}} radio_box {{ $colorname}} "   name="color{{$groups[0]['group_id']}}" color-item-id="{{$group['attribute_option_id1']}}" value="{{$group['attribute_option_id1']}}"  />
                        <span class="color"></span>
                      </label>
                    </li>
                    @endif
                        @endforeach
                    </ul>
                    @endif
                    </div>

              @endif
                  @endif
            </div>

            <!-- <div class="product-add-to-cart">

            <div class="unit_label{{$groups[0]['group_id']}}">
            </div>

            <div class="mon_fri_label{{$groups[0]['group_id']}}">
            </div>

            <div class="sat_label{{$groups[0]['group_id']}}">
            </div>

            <div class="sun_label{{$groups[0]['group_id']}}">
            </div>

            <br/>

            </div> -->
        </div>


             <span class="control-label" style="color:#000">Quantity <span style="color:#8D9299"> (Minimum 50) </span></span>
             <input type="number" name="qty" oninput="changePricelist(this)" value="50"  min="50"  class="input-group form-control product_qty" id="{{$groups[0]['group_id']}}"  aria-label="Quantity" style="display: block;">


             <!-- <div class="product-quantity clearfix">
                 <div class="form-row">

                    <div class=" col-md-5  qty{{$groups[0]['group_id']}}">
                    <div class="input-group bootstrap-touchspin">
                    <input type="number" name="qty" oninput="changePricelist(this)" value="50"  min="50"  class="input-group form-control product_qty" id="{{$groups[0]['group_id']}}"  aria-label="Quantity" style="display: block;">
                    </div>
                    </div>


                 </div>
              </div> -->


            <div class="product-prices" style="margin-top:20px">
                <p style="color: #131415;font-weight:600;margin-bottom:0">Price</p>
                <div class="current-price">
                <!-- <span itemprop="price" content="15">${{$groups[0]['rate']}}</span> -->
                <p style="color: #131415;font-weight:600;font-size: 28px;"> ${{$groups[0]['rate']}}/item</p>
                </div>
            </div>

            <div class="row col-md-5">
                <div class="add">
                <a class="btn btn-default add-to-cart add_cart_group attr-change{{$groups[0]['group_id']}} img-change-btn{{$groups[0]['item_id']}}" style="color:#fff"
                data-item-quantity="{{$groups[0]['group_id']}}" data-item-image-type="{{$groups[0]['image_type']}}"  data-item-id="{{$groups[0]['item_id']}}" data-item-name="{{$groups[0]['group_name']}}" data-item-rate="{{$groups[0]['rate']}}" data-group-id="{{$groups[0]['group_id']}}" data-item-category="{{$groups[0]['category_id']}}"	onclick="additemtocart(this)">
                    Add to cart
                </a>
                </div>
            </div>



            <h2 style="padding-top: 30px;">Description</h2>
                <hr>
            <div class="description" style="margin:10px 0">
                @php 	echo nl2br($groups[0]['description']); @endphp
            </div>


    </div>
  </div>

    </form>
  </div>

</div>
</div>
</div>

 @endforeach
 @endforeach



 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

 <script>

  $(window).scroll(function() {

        var $sections = $('.sections_custom');
        $sections.each(function(i,el){
            var top  = $(el).offset().top-200;
            var bottom = top +$(el).height();
            var scroll = $(window).scrollTop();
            var id = $(el).attr('data-cat-id');
            console.log(id);
            if( scroll > top && scroll < bottom){
                $('.nav-tabs a').removeClass('active');
                $('a[href="#customSection'+id+'"]').addClass('active');
            }
        });

    });




    $('.nav_link').click(function() {
        var category_id = $(this).data("seq");

        $('html, body').animate({
            scrollTop: $(".section_custom"+category_id).offset().top
        }, 2000)
    });





// var id_category = '{{ $category_id }}';

    function changeImage(elem){

        $("#overlay").show();

		var color_id = elem.getAttribute("color-item-id");

        //
        //
        var item_key = elem.getAttribute("data-item-key");

        // alert( color_id.split('_')[0]);
		$("#"+color_id+"_"+item_key).attr('checked', 'checked');
		var data_group_id = elem.getAttribute("data-group");
		 var size = $(".attr_size"+data_group_id+"").val();
         var id_category = elem.getAttribute("data-item-category");

         var data_item_id_group = $('input[type="radio"]:checked').attr("data-item-id-group");




        var classActive = $('input[type="radio"]:checked').attr('class').split(' ')[2];


		$.ajax({
           type:'GET',
           url:"{{ route('customswag_imageChange') }}",
           data:{
		   color_id : color_id,
		   	size_id : size,
		   data_group_id : data_group_id,
           category_id : id_category,
		   data_item_id : $(elem).attr("data-item-id"),
            data_item_id_group:data_item_id_group,
            classActive:classActive,

		   },
		    dataType: 'json',
           success:function(data){

				var item_image = data.item_image;

				var group_id = data.group_id;
				var description = data.description;
				var unit =  data.unit;
				var moq_number =  data.moq_number;

				var mon_fri_val =  data.cf_mon_fri;
				var sat_val =  data.cf_saturday;
				var sun_val =  data.cf_sunday;
				var rate =  data.rate;
				var item_id =  data.item_id;

			    var soh = data.soh;


                var item_name = data.item_name;
                var item_image_type = data.item_image_type;
                var data_item_id_old = data.data_item_id_old;
                var classActive = data.classActive;
                var colorName = data.colorname;




				$(".mon_fri_label"+group_id+"").html(mon_fri_val);
				$(".sat_label"+group_id+"").html(sat_val);
				$(".sun_label"+group_id+"").html(sun_val);
                $(".model-color-grey"+data_group_id+"_"+item_key).html(colorName);




				//if(moq_number > 0){
				//$(".qty"+group_id+"").html('<input type="number" name="qty" oninput="changePricelist(this)" value="'+moq_number+'" class="input-group form-control product_qty" id="'+group_id+'"  min="'+moq_number+'" aria-label="Quantity" style="display: block;">');
                $(".qty"+group_id+"").html('<input type="number" name="qty" oninput="changePricelist(this)" 	value=50  min="50"   class="input-group form-control product_qty" id="'+group_id+'"  aria-label="Quantity" style="display: block;">');

                //}

				if(unit == "Yes"){
					$(".unit_label"+group_id+"").html("<span class='control-label'>Unit</span><div class='qty'><div class='input-group bootstrap-touchspin'><input type='number' name='unit'  required='required' id='unit"+group_id+"' class='input-group form-control unit'  style='display: block'></div></div>");
				}

				if(unit == " "){
					alert('Require Unit Field');
				}

				$(".description").html(description);
				$(".product-cover"+data_group_id+"_"+item_key).html("<img class='card-img-top' src="+item_image+">");
				$(".current-price p").html("$"+rate+'/item');
				$(".soh").html(soh);





                if(itemArray.includes(item_id)){


                    $('.attr-change'+group_id).html('Remove Item');
                }
                else{

                    $('.attr-change'+group_id).html('Add to Cart');
                }

                $('.attr-change'+group_id).attr('data-item-id',item_id);
                $('.attr-change'+group_id).attr('data-item-name',item_name);
                $('.attr-change'+group_id).attr('data-item-rate',rate);
                $('.attr-change'+group_id).attr('data-item-image-type',item_image_type);



				$("#overlay").hide();
		   }
        });

	   }

$(document).ready(function() {

    $('.selectpicker').selectpicker();

 });


    $(document).on('click',"#custom-swag" ,function() {
        if(!$('#addproject').hasClass('active')){
            $('.project-append').css('display','none');
            $('.ml-220').css('display','block');
            $('.col-md-2.fixed-content').show();
            $('#addproject').addClass('active');
            scrollable = true;
        }else{
            $('.project-append').css('display','block');
            $('.ml-220').css('display','none');
            $('.col-md-2.fixed-content').hide();
            $('#addproject').removeClass('active');
        }
    });

    $(document).on('click',"#edit" ,function() {
        if( !$(this).hasClass('collapsed')){
            $('#span-edit').css('display',"none");
        }else{
            $('#span-edit').css('display',"block");
        }
    });
    var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

</script>
@endsection
