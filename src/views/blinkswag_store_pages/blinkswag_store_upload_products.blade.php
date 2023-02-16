@extends('layouts.app')

@section('content')

@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        $domain_name = "/blinkswag-dashboard";
    }

    //dd( $parent_categories );
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


.checkbox-round {
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
</style>


<div id="overlay" style="display:none;">
 <img  src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" alt="" class="spinner1">
</div>



    <div class="row">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <?php
        $counter = 0;
        ?>
        <div class="col-md-2 fixed-content">
            <h2 class="cat-heading">CATEGORIES</h2>
            <ul class="nav nav-tabs categories pb-4" id="myTab" role="tablist">
                @foreach($parent_categories as $k=>$category)
                    <li class="nav-item dropdown">
                        <a class="nav-link nav_link parentcategory getproducts_main navlink{{$category['id']}} {{ $counter==0 ? 'active':'' }}" category_id="{{$category['id']}}" data-toggle="tab" role="tab">{{$category['title']}}</a>
                        <div class="dropdown-menu" style="display:{{ $counter==0 ? 'block':'none' }}; position:initial;">
                            <ul class="nav nav-tabs sub_categories" id="" role="">
                                @foreach($category['child_categories'] as $key=>$cat)
                                    <li class="nav-item dropdown">
                                        <a class="dropdown-item getproducts subcategory{{$cat['id']}}" category_id="{{$cat['id']}}">{{$cat['title']}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </li>
                    <?php
                        $counter++;
                    ?>
                @endforeach
            </ul>
        </div>

        <div class="col-md-7 project-append"></div>

        <div class="col-md-7 ml-220 code-append" >
            <div class="sections section" data-cat-id="" >
                <div class="content_heading">
                <h2>Start Your Upload Images of Products</h2>
                <a class="nav-link btn btn-default" href="{{route('view_uploaded_products')}}" style="position: absolute;right: 0;top: 50px;color: white;">View Uploaded Products</a>
                </div>



                        <div class="sections_custom section_custom" data-cat-id="" style="min-height: 100px;">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-" role="tabpanel">
                                    <div class="row main-tab dev">
                                        @foreach($products as $product)
                                        <div class="col-md-4 product_cat_id product_cat_id{{$product['main_category_id']}}" product_id="{{$product['id']}}">
                                                <div class="content-box">

                                                        <div class="product-image ">
                                                            <img class="img-fluid" src="{{ $product['image']}}">
                                                        </div>
                                                        <div class="product-title">
                                                            <p><strong>{{$product['title']}}</strong></p>
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


<div class="addProductDetails">

</div>




    <div class="row"  id="scroll-hide" style="">
            <div class="form-group" id="scroll-to" ></div>
        </div>



 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
 <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
 <script>
var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function(){
    //wsmemon
    setTimeout(function(){
        $(".getproducts:first").trigger("click");
    }, 100);

    $(document).on("click",".getproducts", function(){
        var category_id = $(this).attr("category_id");
        $(".selected_sub").removeClass("selected_sub");
        $(this).addClass("selected_sub");

        $(".product_cat_id").fadeOut(250);
        $(".product_cat_id"+category_id).fadeIn(250);
    });
    // $(document).on("click",".getproducts_main.active", function(){
    //     var category_id = $(this).attr("category_id");
    //     $(".product_cat_id").fadeIn(250);
    // });
    $(document).on("click",".getproducts_main:not(.active)", function(){
        var category_id = $(this).attr("category_id");
        // $(".loader").show();
        // //alert('Call Api and get all products of '+ category_id);
        // $(".section_custom").html("");
        // $.ajax({
        //     type: "POST",
        //     dataType:'html',
        //     data: {
        //         category_id: category_id,
        //         _token: _token
        //     },
        //     url: "{{$domain_name}}/printful/getAllProductsByCategoryId",
        //     async: true,
        //     success: function(data) {
        //         //console.log( data );
        //         $(".section_custom").html(data);
        //         $(".loader").hide();
        //     }
        // })
        $(".dropdown-menu").hide();
        $(this).next().show();
        $(this).next().find(".getproducts:first").trigger("click");
    });

    function nl2br (str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    $(document).on("click",".product_cat_id", function(){
        $(".loader").show();
        var product_id = $(this).attr("product_id");
        console.log(product_id);
        window.location = "{{$domain_name}}/printful/upload_images_printful_product/"+product_id;
    });

    $(document).on("click", ".checkbox_size", function(){
        var val = $(this).val();
        $(".checkbox_size").each(function(index, value){
            if($(this).is(":checked"))
            {
                $(".allColors_"+$(this).val()).show();
            }else{
                $(".allColors_"+$(this).val()).hide();
            }
        });
        //$(".allColors_view").hide();
    });
    //wsmemon
});
</script>
@endsection
