
@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
        $domain_name = "/blinkswag-dashboard";

    }

    //dd($store);

    //$items = array();
    //$item_groups = array();
    $all_selected_items = [];
    $item_json_fields = [];

    $complete_settings = [];

    if(!empty($store))
    {
        if(!empty($store->all_items_json))
        {
            $all_selected_items = json_decode( $store->all_items_json, true);
        }

        //foreach($all_selected_items as $key => $product)
        //{
        //    if (array_key_exists("group_id",$product))
        //    {
        //        array_push( $item_groups, $product);
        //    }else{
        //        array_push( $items, $product);
        //    }
        //}

    }

    if(!empty($store->complete_settings))
    {
        $complete_settings = json_decode( $store->complete_settings, true);
        $item_json_fields =  $complete_settings['item_json_fields'];

        $hex = $complete_settings['slider']['caption_bg_color'];
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    }

    function hexToRgb($hex) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));

        return $rgb['r']." ".$rgb['g']." ".$rgb['b'];
    }

    //echo '<pre>';
    //print_r( $all_selected_items );
    //exit();

    //dd( $all_categories_details );
    //dd( $products_db );

@endphp

@extends('layouts.app')

@section('content')
<style>
    h1{
        color: #525f7f;
    }
    h3{
        color:white;
    }

    .bi {
        vertical-align: -0.125em;
        fill: currentColor;
    }

    /* Declare heights because of positioning of img element */
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
        /* height: 32rem; */
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
    /* border:1px solid #ccc; */
    margin:0 8px;
    color:inherit;
    opacity:0.75;
    }

    .footer-basic .social > a:hover {
    opacity:0.9;
    }

    .footer-basic .copyright {
    margin-top:15px;
    text-align:center;
    font-size:13px;
    color:#aaa;
    margin-bottom:0;
    }

    .left-menu-item
    {
        display: block;
        padding: 0.5rem 1rem;
        /* color: #0d6efd; */
        text-decoration: none;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
        font-weight: 700;
        cursor: pointer;
        width: 335px;
    }
    .settings_container
    {
        display:none;
        padding: 0.5rem 1rem;
        background: white;
        width: 335px;
    }
    .leftmenubar
    {
        position: fixed;
        background: rgb(120 120 120 / 95%);
        z-index: 9;
        height: 100%;
        left:-600px;
        transition: all 1s ease 0s;
    }
    header{
        position:relative;
    }

    .menubars
    {
        position: absolute;
        left: 40px;
        top: 30px;
        cursor:pointer;
    }
    .dropzone-wrapper {
    border: 2px solid #172b4d;
    border-radius:25px;
    color: #5f5f5f;
    position: relative;
    height: 180px;
    background: #dfdfdf;
    margin:20px;
    }

    .dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
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
    }

    .dropzone-wrapper:hover,
    .dropzone-wrapper.dragover {
    background: #ecf0f5;
    }
    .box-body
    {
        text-align:center;
    }

    .banner{
        position:relative;
    }

    .bg_color,
    .cart_color,
    .caption_color,
    .caption_bg_color,
    .banner_bg_color,
    .banner_text_color,
    .banner_cta_bg_color,
    .footer_bg_color,
    .footer_icon_color,
    .footer_text_color {
    border-radius: 50%;
    width: 20px;
    height: 20px;
    /* background-color:red; */
    display:inline-block;
    }
    input[type=color]::-webkit-color-swatch {
    border: none;
    border-radius: 50%;
    padding: 0;
    }

    input[type=color]::-webkit-color-swatch-wrapper {
        border: none;
        border-radius: 50%;
        padding: 0;
    }
    .input-group-text{
        padding: 0.6rem 0.75rem;
    }
    .form-group.slide {
        border-bottom: 2px #bcbaba groove;
        margin-bottom: 5px;
        padding-bottom: 10px;
        position: relative;
    }
    span.close {
        position: absolute;
        right: 2px;
        cursor: pointer;
        font-size: 18px;
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
    .fixed-top
    {
        margin-top:100.5px;
    }
    button.close.closeLeftMenu {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .dropzone,
    .dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 150px;
    cursor: pointer;
    opacity: 0;
    }

    .dropzone-wrapper:hover,
    .dropzone-wrapper.dragover {
    background: #ecf0f5;
    }
    .selectfromgallery {
        position: absolute;
        right: 10px;
        top: 5px;
        cursor: pointer;
    }

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
    .delete_galleryimage_icon
    {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }
    .delete_galleryimage_icon:hover
    {
        color:#a60000;
    }

    /* products */
    button.btn-view.btn-load-more.btn.btn-default {
        margin: 0 auto;
        display: block;
    }

    ul {
    list-style-type: none;
    }

    li {
    display: inline-block;
    }

    .checkbox{
    display:none
    }

    .label {
    border: 4px solid #fff;

    position: relative;
    margin: 10px;
    cursor: pointer;
    }

    .label:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;

    border: 1px solid #32325d;
    position: absolute;

    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
    z-index: 999;
    }

    .label img {
    height: 100px;
    width: 100px;
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
    }

    :checked + .label {
    border-color: #32325d;
    }

    :checked + .label:before {
    content: "✓";
        background-color: #32325d;
        transform: scale(1);
        font-weight: 800;
        padding: 5px;
        font-size: 18px;
    }

    :checked + .label img {
    transform: scale(0.9);
    /* box-shadow: 0 0 5px #333; */
    /* z-index: -1; */
    }

    .add_field_icon
    {
        position: absolute;
        right: -60px;
        top: 24px;
        padding: 5px;
        color: #32325d;
        cursor: pointer;
        z-index: 9;
        font-size: 18px;
    }

    .products_container_selected .card
    {
        text-align: left;
    }
    .products_container_selected h3,
    #selectproductsModal h3
    {
        color: #38393a;
    }
    .products_container_selected label{
        margin:0px;
    }

    ul.categories.nav.nav-tabs li {
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
    /* .checkbox-round:checked {
        border: 2px solid #0075ff;
        box-shadow: 0px 0px 5px;
    } */

</style>


<input type="hidden" id="all_products" value="{{json_encode($products_db)}}" />

    <!-- Modal -->
    <div class="modal fade" id="selectproductsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">

        @php $on_demand=0; @endphp
        @foreach ($items as $item)
            @if (array_key_exists('cf_on_demand', $item) && $item['cf_on_demand'] == 'true')
                @php $on_demand++; @endphp
            @endif
        @endforeach

        <div class="modal-dialog" role="document" style="min-width: 1050px;">
            <div class="modal-content" style="overflow-y: auto;overflow-x: hidden;">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectproductsModallabel">Products</h5>
                    <button type="button" class="close closeproductspopup" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                            @foreach ($items as $item)
                                @if (array_key_exists('cf_on_demand', $item) && $item['cf_on_demand'] == 'true' && $item['cf_client_dashboard'] == 'Yes')
                                    <h2 style="margin-top:30px;margin-left: 30px;">On Demand Items</h2>
                                    @break;
                                @endif
                            @endforeach

                            <div class="row" id="on_demand_products" style="margin-right: 0px !important;margin-left: 0px !important;margin-top: -40px;">
                                    @php
                                    $products = array();
                                    $count = 0;
                                    $id = 1;
                                    @endphp
                                    @foreach($all_selected_items as $key => $product)
                                    @if( array_key_exists("group_id", $product) )
                                        @php $products[] .= $product['group_id']; @endphp
                                    @else
                                        @php $products[] .= $product['item_id']; @endphp
                                    @endif
                                    @endforeach
                                    <div id="redeem_products_id" style="display:none">{{json_encode($products)}}</div>
                                        @foreach ($items as $item)
                                            @if (array_key_exists('cf_on_demand', $item) && $item['cf_on_demand'] == 'true' && $item['cf_client_dashboard'] == 'Yes')
                                                @if (!array_key_exists('group_id', $item))
                                                <div class="col-xl-3 col-lg-6" style="margin: 30px">
                                                    <input type="checkbox" id="{{ $item['item_id'] }}" class="checkbox" name="item_id[]" id="item_id[]"  value="{{ $item['item_id'] }}_0" @if (in_array($item['item_id'], $products)) checked @endif >
                                                    <label class="label" for="{{ $item['item_id'] }}">
                                                        <div class="card"
                                                            style="width: 19rem;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);border-radius: 10px;padding: 15px;">
                                                            <div
                                                                style="display: flex;align-items: center;height: 240px;flex-wrap: nowrap;align-content: center;justify-content: center;">
                                                                <img class="card-img-top"
                                                                    src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}"
                                                                    alt="Card image cap" style="height: auto;width: 150px;">
                                                            </div>
                                                            <div class="card-body" style="border-top: solid;height: 190px;">
                                                                <span style="float: right;">${{ $item['rate'] }}</span>

                                                                <h3 style="margin-bottom:10px;color: #525f7f;">{{ $item['item_name'] }}</h3>

                                                            </div>
                                                        </div>
                                                    </label>
                                                    @php
                                                    $inner_fields = "{}";
                                                    if( array_key_exists($item['item_id'], $item_json_fields) )
                                                    {
                                                        $inner_fields = $item_json_fields[ $item['item_id'] ];
                                                    }
                                                    @endphp
                                                    <!-- <i class="fa fa-align-justify add_field_icon" json_fields='< ?=$inner_fields?>' id="{{$item['item_id']}}" aria-hidden="true"></i> -->
                                                </div>
                                            @endif
                                            @endif
                                        @endforeach
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                    <div class="col-12">
                    <h2 style="margin-top:30px; margin-left:30px">Inventory Items</h2>
                                <div class="row loadMore">

                                    @foreach ($item_group as $groups)

                                    @foreach($groups as $group_check)
                                            @if((array_key_exists('actual_available_stock', $group_check) && $group_check['actual_available_stock'] > 0 && array_key_exists('cf_on_demand', $group_check) && $group_check['cf_on_demand'] == 'false') || (array_key_exists('actual_available_stock', $group_check) && array_key_exists('cf_on_demand', $group_check) && $group_check['cf_on_demand'] == 'true') )


                                        <div class="col-xl-3 col-lg-6" style="margin: 30px">


                                            <input type="checkbox"
                                                    id="{{ $groups[0]['group_id'] }}" class="checkbox" name="item_id[]"  value="{{ $groups[0]['group_id'] }}_1" @if (in_array($groups[0]['group_id'], $products)) checked @endif   >

                                                <label  class="label" for="{{ $groups[0]['group_id'] }}">

                                                    <div class="card"
                                                        style="width: 19rem;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);border-radius: 10px;padding: 15px;">
                                                        <div
                                                            style="display: flex;align-items: center;height: 240px;flex-wrap: nowrap;align-content: center;justify-content: center;">
                                                            <img class="card-img-top"
                                                                src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $groups[0]['item_id'] }}.{{ $groups[0]['image_type'] }}"
                                                                alt="Card image cap" style="height: auto;width: 150px;">
                                                        </div>
                                                        <div class="card-body" style="border-top: solid;height: 190px;">
                                                            <span style="float: right;">${{ $groups[0]['rate'] }}</span>

                                                            <h3 style="margin-bottom:10px;">{{ $groups[0]['group_name'] }}</h3>

                                                        </div>
                                                    </div>
                                                    </label>
                                                    @php
                                                    $inner_fields = "{}";
                                                    if( array_key_exists($groups[0]['group_id'], $item_json_fields) )
                                                    {
                                                        $inner_fields = $item_json_fields[ $groups[0]['group_id'] ];
                                                    }
                                                    @endphp
                                                    <!-- <i class="fa fa-align-justify add_field_icon" json_fields='<?=$inner_fields?>' id="{{$groups[0]['group_id']}}" aria-hidden="true" style="right: -45px;top: 24px;"></i> -->
                                                </div>

                                                @php break;
                                                    @endphp
                                                    @endif
                                                    @endforeach

                                        @endforeach


                                        @foreach ($items as $item)
                                        @if ((array_key_exists('cf_client_dashboard', $item) && $item['cf_client_dashboard'] == 'Yes' && $item['cf_on_demand'] != 'true') )
                                        @if (!array_key_exists('group_id', $item))
                                        @if((array_key_exists('actual_available_stock', $item) && $item['actual_available_stock'] > 0 && array_key_exists('cf_on_demand', $item) && $item['cf_on_demand'] == 'false') || (array_key_exists('actual_available_stock', $item) && array_key_exists('cf_on_demand', $item) && $item['cf_on_demand'] == 'true') )

                                        <div class="col-xl-3 col-lg-6" style="margin: 30px">

                                                <input type="checkbox"
                                                    id="{{ $item['item_id'] }}" name="item_id[]"  value="{{ $item['item_id'] }}_0"   class="checkbox" @if (in_array($item['item_id'], $products)) checked @endif  >

                                                <label class="label" for="{{ $item['item_id'] }}">
                                                    <div class="card"
                                                        style="width: 19rem;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);border-radius: 10px;padding: 15px;">
                                                        <div
                                                            style="display: flex;align-items: center;height: 240px;flex-wrap: nowrap;align-content: center;justify-content: center;">
                                                            <img class="card-img-top"
                                                                src="https://dashboard.blinkswag.com/storage/app/ItemImages/{{ $item['item_id'] }}.{{ $item['image_type'] }}"
                                                                alt="Card image cap" style="height: auto;width: 150px;z-index:999999">
                                                        </div>
                                                        <div class="card-body" style="border-top: solid;height: 190px;">
                                                            <span style="float: right;">${{ $item['rate'] }}</span>
                                                            @if (array_key_exists('actual_available_stock', $item))
                                                                <span data-soh={{ $item['actual_available_stock'] }}
                                                                    id="quantity{{ $item['item_id'] }}"><b>SOH:</b>{{ $item['actual_available_stock'] }}</span>
                                                            @else
                                                                <span data-soh=0 id="quantity{{ $item['item_id'] }}"><b>SOH:</b>0</span>
                                                            @endif

                                                            <h3 style="margin-bottom:10px;">{{ $item['item_name'] }}</h3>


                                                        </div>
                                                    </div>
                                                </label>
                                                    @php
                                                    $inner_fields = "{}";
                                                    if( array_key_exists($item['item_id'], $item_json_fields) )
                                                    {
                                                        $inner_fields = $item_json_fields[ $item['item_id'] ];
                                                    }
                                                    @endphp
                                                    <!-- <i class="fa fa-align-justify add_field_icon" json_fields='< ?=$inner_fields?>' id="{{$item['item_id']}}" aria-hidden="true"></i> -->

                                                </div>
                                                @endif
                                            @endif
                                            @endif
                                        @endforeach
                                    <div class="app row"></div>
                                    </div>
                                </div>
                    </div>
                </div>
                </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="addfields_modal" tabindex="-2" role="dialog" aria-labelledby="addfields_modal" aria-hidden="true" style="z-index: 99999;">
  <div class="modal-dialog" role="document" style="max-width: 700px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Fields</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
         <!--  Bootstrap table-->
            <div class="table table-responsive p-0 m-0 mr-0  w-100" style="overflow-x: hidden;">
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Field Name</th>
                            <th scope="col">Field Type</th>
                            <th scope="col">Required</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table_fields">

                    </tbody>
                </table>
            </div>
            <!-- Add rows button-->
            <a class="btn btn-primary rounded-0 btn-block" id="insertRow" href="#">Add new</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary savefields_item">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="galleryModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="    min-width: 670px;">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModallabel">Image Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                            aria-selected="true">My Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                            aria-selected="false">Upload</a>
                        </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row p-3 px-4 justify-content-center mygallery_container">
                                    <?php
                                        $dir = public_path('Image/'.Auth::user()->id_company);
                                        if (is_dir($dir)) {
                                            if ($dh = opendir($dir)) {
                                                while (($file = readdir($dh)) !== false) {
                                                    if($file!="." && $file!="..")
                                                    {
                                                        //echo $file."<br>";
                                                        echo "<div class='col-md-3 gallery_image_view_con' style='position:relative;'>";
                                                        echo '<i class="fa fa-trash delete_galleryimage_icon" aria-hidden="true" filename="'.$file.'"></i>';
                                                        echo "<img class='gallery_image_view' src='".url('/').'/Image/'.Auth::user()->id_company."/".$file."' /> <br />";
                                                        echo "</div>";
                                                    }
                                                }
                                                closedir($dh);
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 my-4 pr-5 text-right">
                                        <button type="button" class="btn btn-info addimage">Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="dropzone-wrapper gallery_wrapper">
                                    <div class="preview-zone hidden">
                                        <div class="box box-solid">
                                            <div class="box-body">
                                                <!-- <img style="max-width: 200px; height:40px; padding:5px;" src="{{env('App_URL')}}/public/assets/img/blinkswaglogo_white.png" /> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone-desc">
                                        <p>Drag and drop to upload or choose file <br>
                                        Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                    </div>
                                    <input  type="file" name="gallery" id="gallery" value="" accept="image/*"  class="dropzone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<?php
    $header_bg_color = "#212529";
    $header_sticky = "";
    $logo_path = env('App_URL')."/public/assets/img/blinkswaglogo_white.png";
    $cart_icon_color = "#ffffff";
    $header_is_sticky = "";

    $showslider = "checked";
    $showslider_css = "";
    $slidercaptioncolor = "#ffffff";
    $caption_bg_color = "#000000";

    $showbanner = "checked";
    $showbanner_css = "";
    $banner_heading = "Responsive left-aligned banner with image";
    $banner_description = "Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.";
    $banner_cta_text = "Swag Here";
    $banner_path = "https://blinkswag.com/img/cms/blinkswag_swagbox_1.png";
    $banner_overlay_path = "https://blinkswag.com/img/cms/1000_F_229391806_oaIIprMsAZjlQ8OgsIA8mxkxdhUFY7nD.jpg";
    $banner_bg_color2 = "#CCCCCC";
    $banner_text_color2 = "#525f7f";
    $banner_cta_bg_color2 = "#0d6efd";


    $instagram_text = "";
    $snapchat_text = "";
    $twitter_text = "";
    $facebook_text = "";
    $company_name = "";
    $footer_bg_color2 = "#ffffff";
    $footer_icon_color2 = "#38393a";
    $footer_text_color2 = "#aaaaaa";


    if(!empty($complete_settings))
    {
        if($complete_settings['header']['header_bg_color'])
        {
            $header_bg_color = $complete_settings['header']['header_bg_color'];
        }
        if($complete_settings['header']['header_sticky'] == 1)
        {
            $header_sticky = "fixed-top";
            $header_is_sticky = "checked";
        }
        if($complete_settings['header']['logo_path'])
        {
            $logo_path = $complete_settings['header']['logo_path'];
        }
        if($complete_settings['header']['cart_icon_color'])
        {
            $cart_icon_color = $complete_settings['header']['cart_icon_color'];
        }

        //slider
        if($complete_settings['slider']['show_sider'] == 1)
        {
            $showslider_css = "display:block;";
            $showslider = "checked";
        }else{
            $showslider_css = "display:none;";
            $showslider = "";
        }
        if($complete_settings['slider']['caption_color'])
        {
            $slidercaptioncolor = $complete_settings['slider']['caption_color'];
        }
        if($complete_settings['slider']['caption_bg_color'])
        {
            $caption_bg_color = $complete_settings['slider']['caption_bg_color'];
        }

        //banner
        if($complete_settings['banner']['show_banner'] == 1)
        {
            $showbanner_css = "display:block;";
            $showbanner = "checked";
        }else{
            $showbanner_css = "display:none;";
            $showbanner = "";
        }
        if($complete_settings['banner']['banner_heading'])
        {
            $banner_heading = $complete_settings['banner']['banner_heading'];
        }
        if($complete_settings['banner']['banner_description'])
        {
            $banner_description = $complete_settings['banner']['banner_description'];
        }
        if($complete_settings['banner']['banner_cta_text'])
        {
            $banner_cta_text = $complete_settings['banner']['banner_cta_text'];
        }
        if($complete_settings['banner']['banner_path'])
        {
            $banner_path = $complete_settings['banner']['banner_path'];
        }
        if($complete_settings['banner']['banner_overlay_path'])
        {
            $banner_overlay_path = $complete_settings['banner']['banner_overlay_path'];
        }
        if($complete_settings['banner']['banner_bg_color2'])
        {
            $banner_bg_color2 = $complete_settings['banner']['banner_bg_color2'];
        }
        if($complete_settings['banner']['banner_text_color2'])
        {
            $banner_text_color2 = $complete_settings['banner']['banner_text_color2'];
        }
        if($complete_settings['banner']['banner_cta_bg_color2'])
        {
            $banner_cta_bg_color2 = $complete_settings['banner']['banner_cta_bg_color2'];
        }

        if($complete_settings['footer']['instagram_text'])
        {
            $instagram_text = $complete_settings['footer']['instagram_text'];
        }
        if($complete_settings['footer']['snapchat_text'])
        {
            $snapchat_text = $complete_settings['footer']['snapchat_text'];
        }
        if($complete_settings['footer']['twitter_text'])
        {
            $twitter_text = $complete_settings['footer']['twitter_text'];
        }
        if($complete_settings['footer']['facebook_text'])
        {
            $facebook_text = $complete_settings['footer']['facebook_text'];
        }
        if($complete_settings['footer']['company_name'])
        {
            $company_name = $complete_settings['footer']['company_name'];
        }
        if($complete_settings['footer']['footer_bg_color2'])
        {
            $footer_bg_color2 = $complete_settings['footer']['footer_bg_color2'];
        }
        if($complete_settings['footer']['footer_icon_color2'])
        {
            $footer_icon_color2 = $complete_settings['footer']['footer_icon_color2'];
        }
        if($complete_settings['footer']['footer_text_color2'])
        {
            $footer_text_color2 = $complete_settings['footer']['footer_text_color2'];
        }




    }
?>

<div class="leftmenubar w-25" tabindex="-1" style="left: 0px;top: 0px;z-index: 9999;">

    <div style="position: absolute;left: 210px;z-index: 99999;bottom: 15px;">
        <button type="button" class="btn btn-primary savestore" store_id="{{$store->id}}">Save store</button>
    </div>
    <div class="offcanvas-header m-3" style="position:relative;">
        <h1 class="offcanvas-title d-none d-sm-block text-white" id="offcanvas">Settings</h1>
        <!-- <button type="button" class="btn-close text-reset "></button> -->
        <button type="button" class="close closeLeftMenu" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="px-0" style="overflow-y: scroll;height: 90%;overflow-x: hidden;padding-bottom: 80px;">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
            <li class="nav-item">
                <span href="#" class="left-menu-item">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Header</span>
                </span>
                <div class="settings_container">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Sticky Header</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <input id="sticky_header" {{$header_is_sticky}} type="checkbox" class="js-switch" data-size="small" />
                            </div>
                        </div>

                    </div>

                    <div class="form-group" style="position:relative;">
                        <label for="logo">Add logo image URL</label>
                        <input type="text" class="form-control changeimageonblur" name="logo_path" id="logo_path" placeholder="https://logo image path.com/" value="{{$logo_path}}">
                        <div class="selectfromgallery" title="Select from Gallery" attr_id="logo_path" data-toggle="modal" data-target="#galleryModal"><i class="ni ni-image"></i></div>
                        <!-- <div class="dropzone-wrapper logo_wrapper">
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <img style="max-width: 200px; height:40px; padding:5px;" src="{{env('App_URL')}}/public/assets/img/blinkswaglogo_white.png" />
                                    </div>
                                </div>
                            </div>
                            <div class="dropzone-desc">
                                <p>Drag and drop to upload or choose file <br>
                                Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                            </div>
                            <input  type="file" name="logo" id="logo" value="" accept="image/*"  class="dropzone">
                        </div> -->
                    </div>

                    <div class="form-group">
                            <label for="page_name" >Background Color</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="color" name="bg_color"  value="{{$header_bg_color}}" class="bg_color" >
                                </div>
                                </div>
                                <input type="text"  name="bg_color" value="{{$header_bg_color}}" class="form-control bg_color2">
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="page_name" >Cart Icon Color</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="color" name="cart_color"  value="{{$cart_icon_color}}" class="cart_color" >
                                </div>
                                </div>
                                <input type="text"  name="cart_color" value="{{$cart_icon_color}}" class="form-control cart_color2">
                            </div>
                    </div>
                </div>
            </li>
            <li>
                <span href="#submenu1" data-bs-toggle="collapse" class="left-menu-item">
                    <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Slider</span>
                </span>
                <div class="settings_container">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label" for="chk_1">Show Slider</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <input id="chk_1" {{$showslider}} type="checkbox" class="js-switch" data-size="small" />
                            </div>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Caption Color</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="color" name="caption_color"  value="{{$slidercaptioncolor}}" class="caption_color" >
                                        </div>
                                        </div>
                                        <input type="text"  name="caption_color" value="{{$slidercaptioncolor}}" class="form-control caption_color2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Caption bg Color</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="color" name="caption_bg_color"  value="{{$caption_bg_color}}" class="caption_bg_color" >
                                        </div>
                                        </div>
                                        <input type="text"  name="caption_bg_color" value="{{$caption_bg_color}}" class="form-control caption_bg_color2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="slider_container">
                    @if(!empty($complete_settings))
                        @foreach($complete_settings['slider']['slides'] as $key=>$slide)
                            <div class="form-group slide slide{{($key+1)}}">
                                <span class="close" index="slide{{($key+1)}}">&times;</span>
                                <label class="control-label title_label">Slide{{($key+1)}} Title</label>
                                <input type="text" class="form-control title" index="slide{{($key)}}" value="{{$slide['title']}}" />
                                <br>
                                <label class="control-label description_label">Slide{{($key+1)}} Description</label>
                                <input type="text" class="form-control description" index="slide{{($key)}}" value="{{$slide['description']}}" />
                                <br>
                                <label class="control-label image_label">Slide{{($key+1)}} Image</label>
                                <div style="position:relative;">
                                <input type="text" class="form-control changeimageonblur" name="sliderslide{{($key+1)}}_path" id="sliderslide{{($key+1)}}_path" placeholder="https://Slider_image_path.com/" value="{{$slide['image_path']}}">
                                <div class="selectfromgallery" title="Select from Gallery" attr_id="sliderslide{{($key+1)}}_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="form-group slide slide1">
                            <span class="close" index="1">&times;</span>
                            <label class="control-label title_label">Slide1 Title</label>
                            <input type="text" class="form-control title" index="0" value="What is Lorem Ipsum" />
                            <br>
                            <label class="control-label description_label">Slide1 Description</label>
                            <input type="text" class="form-control description" index="0" value="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries," />
                            <br>
                            <label class="control-label image_label">Slide1 Image</label>
                            <div style="position:relative;">
                            <input type="text" class="form-control changeimageonblur" name="slider1_path" id="slider1_path" placeholder="https://Slider_image_path.com/" value="https://blinkswag.com/img/cms/blinkswag_swag_header.jpg">
                            <div class="selectfromgallery" title="Select from Gallery" attr_id="slider1_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                            </div>
                            <!-- <div class="dropzone-wrapper slider_wrapper">
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img style="max-width: 200px; height:40px; padding:5px;" src="https://blinkswag.com/img/cms/blinkswag_swag_header.jpg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="dropzone-desc">
                                    <p>Drag and drop to upload or choose file <br>
                                    Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                </div>
                                <input  type="file" name="slider_image" id="" index="0" value="" accept="image/*"  class="dropzone slider_image">
                            </div> -->

                        </div>
                        <div class="form-group slide slide2">
                            <span class="close" index="2">&times;</span>
                            <label class="control-label title_label">Slide2 Title</label>
                            <input type="text" class="form-control title" index="1" value="What is Lorem Ipsum" />
                            <br>
                            <label class="control-label description_label">Slide2 Description</label>
                            <input type="text" class="form-control description" index="1" value="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries," />
                            <br>
                            <label class="control-label image_label">Slide2 Image</label>
                            <div style="position:relative;">
                            <input type="text" class="form-control changeimageonblur" name="slider2_path" id="slider2_path" placeholder="https://Slider_image_path.com/" value="https://blinkswag.com/img/cms/branding-stationery-mockup-scene-copy.png">
                            <div class="selectfromgallery" title="Select from Gallery" attr_id="slider2_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                            </div>
                            <!-- <div class="dropzone-wrapper slider_wrapper">
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img style="max-width: 200px; height:40px; padding:5px;" src="https://blinkswag.com/img/cms/branding-stationery-mockup-scene-copy.png" />
                                        </div>
                                    </div>
                                </div>
                                <div class="dropzone-desc">
                                    <p>Drag and drop to upload or choose file <br>
                                    Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                </div>
                                <input  type="file" name="slider_image" id="" index="1" value="" accept="image/*"  class="dropzone slider_image">
                            </div> -->
                        </div>
                        <div class="form-group slide slide3">
                            <span class="close" index="3">&times;</span>
                            <label class="control-label title_label">Slide3 Title</label>
                            <input type="text" class="form-control title" index="2" value="What is Lorem Ipsum" />
                            <br>
                            <label class="control-label description_label">Slide3 Description</label>
                            <input type="text" class="form-control description" index="2" value="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries," />
                            <br>
                            <label class="control-label image_label">Slide3 Image</label>
                            <div style="position:relative;">
                            <input type="text" class="form-control changeimageonblur" name="slider3_path" id="slider3_path" placeholder="https://Slider_image_path.com/" value="https://blinkswag.com/img/cms/open-catalog-mockup-template%20(3).png">
                            <div class="selectfromgallery" title="Select from Gallery" attr_id="slider3_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                            </div>
                            <!-- <div class="dropzone-wrapper slider_wrapper">
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img style="max-width: 200px; height:40px; padding:5px;" src="https://blinkswag.com/img/cms/open-catalog-mockup-template%20(3).png" />
                                        </div>
                                    </div>
                                </div>
                                <div class="dropzone-desc">
                                    <p>Drag and drop to upload or choose file <br>
                                    Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                </div>
                                <input  type="file" name="slider_image" id="" index="2" value="" accept="image/*"  class="dropzone slider_image">
                            </div> -->
                        </div>

                    @endif

                    </div>

                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-info addslide text-white">Add Slide</button>
                        </div>
                    </div>


                </div>
            </li>
            <li>
                <span href="#" class="left-menu-item">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Banner</span>
                </span>
                <div class="settings_container">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label class="control-label">Show Banner</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <input id="chk_2" type="checkbox" {{$showbanner}} class="js-switch" data-size="small" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="control-label">Banner Heading</label>
                        <input type="text" class="form-control banner_heading" index="1" value="{{$banner_heading}}" />
                        <br>
                        <label class="control-label">Banner Description</label>
                        <input type="text" class="form-control banner_description" index="1" value="{{$banner_description}}" />
                        <br>
                        <label class="control-label">Banner CTA Text</label>
                        <input type="text" class="form-control banner_cta_text" index="1" value="{{$banner_cta_text}}" />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Banner Image</label>
                                <div style="position:relative;">
                                <input type="text" class="form-control changeimageonblur" name="banner_path" id="banner_path" placeholder="https://Slider_image_path.com/" value="{{$banner_path}}">
                                <div class="selectfromgallery" title="Select from Gallery" attr_id="banner_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                                </div>
                                <!-- <div class="dropzone-wrapper banner_wrapper">
                                    <div class="preview-zone hidden">
                                        <div class="box box-solid">
                                            <div class="box-body">
                                                <img style="max-width: 200px; height:40px; padding:5px;" src="https://blinkswag.com/img/cms/blinkswag_swagbox_1.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone-desc">
                                        <p>Drag and drop to upload or choose file <br>
                                        Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                    </div>
                                    <input type="file" name="banner_image" id="banner_image" value="" accept="image/*" class="dropzone">
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Banner Overlay Image</label>
                                <div style="position:relative;">
                                <input type="text" class="form-control changeimageonblur" name="banner_overlay_path" id="banner_overlay_path" placeholder="https://Slider_image_path.com/" value="{{$banner_overlay_path}}">
                                <div class="selectfromgallery" title="Select from Gallery" attr_id="banner_overlay_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                                </div>
                                <!-- <div class="dropzone-wrapper banneroverlay_wrapper">
                                    <div class="preview-zone hidden">
                                        <div class="box box-solid">
                                            <div class="box-body">
                                                <img style="max-width: 200px; height:40px; padding:5px;" src="https://blinkswag.com/img/cms/1000_F_229391806_oaIIprMsAZjlQ8OgsIA8mxkxdhUFY7nD.jpg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone-desc">
                                        <p>Drag and drop to upload or choose file <br>
                                        Accepted file types: .PNG, .GIF, .JPEG, .JPG, .SVG</p>
                                    </div>
                                    <input  type="file" name="banneroverlay_image" id="banneroverlay_image" value="" accept="image/*"  class="dropzone">
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Banner bg Color</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="color" name="banner_bg_color"  value="{{$banner_bg_color2}}" class="banner_bg_color" >
                                        </div>
                                        </div>
                                        <input type="text"  name="banner_bg_color" value="{{$banner_bg_color2}}" class="form-control banner_bg_color2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Banner Text Color</label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="color" name="banner_text_color"  value="{{$banner_text_color2}}" class="banner_text_color" >
                                        </div>
                                        </div>
                                        <input type="text"  name="banner_text_color" value="{{$banner_text_color2}}" class="form-control banner_text_color2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Banner CTA bg Color</label>
                                </div>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="color" name="banner_cta_bg_color"  value="{{$banner_cta_bg_color2}}" class="banner_cta_bg_color" >
                                            </div>
                                            </div>
                                            <input type="text"  name="banner_cta_bg_color" value="{{$banner_cta_bg_color2}}" class="form-control banner_cta_bg_color2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </li>
            <li>
                <span href="#" class="left-menu-item">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Products</span>
                </span>
                <div class="settings_container">
                    <div class="row mr-2">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary selectproducts" data-toggle="modal" data-target="#selectproductsModal">Select products</button>
                        </div>
                    </div>

                </div>
            </li>

            <li>
                <span href="#" class="left-menu-item">
                    <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Footer</span>
                </span>
                <div class="settings_container">
                        <label class="control-label">Social Links</label>
                        <input type="text" class="form-control instagram_text mb-2" placeholder="https://www.instagram.com/" value="{{$instagram_text}}" />
                        <input type="text" class="form-control snapchat_text mb-2" placeholder="https://snapchat.com/" value="{{$snapchat_text}}" />
                        <input type="text" class="form-control twitter_text mb-2" placeholder="https://twitter.com/" value="{{$twitter_text}}" />
                        <input type="text" class="form-control facebook_text" placeholder="https://facebook.com/" value="{{$facebook_text}}" />
                        <br>
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control company_name mb-2" placeholder="Company Name" value="{{$company_name}}" />
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Footer bg Color</label>
                                </div>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="color" name="footer_bg_color"  value="{{$footer_bg_color2}}" class="footer_bg_color" >
                                            </div>
                                            </div>
                                            <input type="text"  name="footer_bg_color" value="{{$footer_bg_color2}}" class="form-control footer_bg_color2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Footer icon Color</label>
                                </div>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="color" name="footer_icon_color"  value="{{$footer_icon_color2}}" class="footer_icon_color" >
                                            </div>
                                            </div>
                                            <input type="text"  name="footer_icon_color" value="{{$footer_icon_color2}}" class="form-control footer_icon_color2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Footer Text Color</label>
                                </div>
                            </div>
                            <div class="col-6" style="text-align:right;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="color" name="footer_text_color"  value="{{$footer_text_color2}}" class="footer_text_color" >
                                            </div>
                                            </div>
                                            <input type="text"  name="footer_text_color" value="{{$footer_text_color2}}" class="form-control footer_text_color2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<header class="p-3 bg_header text-white {{$header_sticky}}" style="background-color:{{$header_bg_color}};">
    <div class="container">
        <div class="menubars">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="d-flex flex-wrap align-items-center" style="justify-content: space-between !important;">
        <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <img src="{{$logo_path}}" class="img-fluid"  id="logo_path_view" alt="logo image" style="object-fit: contain; height:40px; margin:5px 5px;" >
        </a>

        <div class="text-end">
            <i class="fa fa-shopping-cart cart_header" style="color:{{$cart_icon_color}};" aria-hidden="true"></i>
        </div>
        </div>
    </div>
</header>

<?php
if(!empty($complete_settings))
{
    if($complete_settings['header']['header_sticky'] == 1)
    {
        ?>
        <div class="extra_space" style="height:82px;"></div>
        <?php
    }
}
?>

<div id="myCarousel" class="slider carousel slide" data-ride="carousel" style="{{$showslider_css}}">
  <ol class="carousel-indicators">
    @if(!empty($complete_settings))
        @foreach($complete_settings['slider']['slides'] as $key=>$slide)
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{($key==0) ? 'active':''}}"></li>
        @endforeach
    @else
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    @endif

  </ol>

  <div class="carousel-inner">
        @if(!empty($complete_settings))
            @foreach($complete_settings['slider']['slides'] as $key=>$slide)
                <div class="carousel-item {{($key==0) ? 'active':''}}">
                    <img class="d-block w-100" id="slider{{($key+1)}}_path_view" src="{{$slide['image_path']}}">
                    <div class="carousel-caption d-none d-md-block" style="background-color:rgba({{hexToRgb($complete_settings['slider']['caption_bg_color'])}} / 78%);" >
                        <h3 style="color:{{$complete_settings['slider']['caption_color']}}">{{$slide['title']}}</h3>
                        <p style="color:{{$complete_settings['slider']['caption_color']}}">{{$slide['description']}}</p>
                    </div>
                </div>
            @endforeach
        @else
        <div class="carousel-item active">
            <img class="d-block w-100" id="slider1_path_view" src="https://blinkswag.com/img/cms/blinkswag_swag_header.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>What is Lorem Ipsum?</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" id="slider2_path_view" src="https://blinkswag.com/img/cms/branding-stationery-mockup-scene-copy.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>What is Lorem Ipsum?</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" id="slider3_path_view" src="https://blinkswag.com/img/cms/open-catalog-mockup-template%20(3).png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>What is Lorem Ipsum?</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>
        </div>
        @endif
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

<!--BANNER-->
<div class="banner col-xxl-8 px-5" style="{{$showbanner_css}}">
    <div class="banner_bg_color_view" style="background-color:{{$banner_bg_color2}}"></div>
    <div class="overlay" id="banner_overlay_path_view" style="background-image: url({{$banner_overlay_path}});"></div>
    <div class="row flex-lg-row-reverse align-items-center">
        <div class="col-10 col-sm-8 col-lg-6">
        <img src="{{$banner_path}}" id="banner_path_view" class="d-block mx-lg-auto img-fluid banner_image_view" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3 banner_heading_view" style="color:{{$banner_text_color2}}">{{$banner_heading}}</h1>
        <p class="lead banner_description_view" style="color:{{$banner_text_color2}}">{{$banner_description}}</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="" class="btn text-white banner_button_view" style="margin-top: 50px;font-weight:bold;background-color:{{$banner_cta_bg_color2}} !important;">
                {{$banner_cta_text}}
            </a>
        </div>
        </div>
    </div>
</div>
<!--BANNER-->

<div class="container text-center mt-5">
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
                                            @foreach($products_db as $key=>$product)
                                            <div class="col-md-4 product_cat_id product_cat_id{{$product->product->main_category_id}}" category_title="{{$all_categories_details[$product->product->main_category_id]['title']}}" product_id="{{$product->product->id}}" product_index="{{$key}}">
                                                    <div class="content-box">

                                                            <div class="product-image ">
                                                                <img class="img-fluid" src="{{ $product->product->image}}">
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
  <div class="row products_container_selected" style="pointer-events: none;">
  </div>
</div><br>

<div class="footer-basic" style="background-color:{{$footer_bg_color2}};">
    <footer>
        <div class="social">
            <a class="instagram" href="#"><i class="icon ion-social-instagram" style="color:{{$footer_icon_color2}};"></i></a>
            <a class="snapchat" href="#"><i class="icon ion-social-snapchat" style="color:{{$footer_icon_color2}};"></i></a>
            <a class="twitter" href="#"><i class="icon ion-social-twitter" style="color:{{$footer_icon_color2}};"></i></a>
            <a class="facebook" href="#"><i class="icon ion-social-facebook" style="color:{{$footer_icon_color2}};"></i></a>
        </div>
        <!-- <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul> -->
        <p class="copyright" style="color:{{$footer_text_color2}}"><span class="company_name_label">{{$company_name}}</span> © 2022</p>
    </footer>

</div>

<div class="addProductDetails" style="z-index: 9999;position: absolute;">

</div>

<script type="text/javascript">

    window._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	window.products = JSON.parse($("#all_products").val());
	window.my_editing = @json($my_editing_products);
	window.general_my_editing = @json($my_editing);
	window.general_my_editing_single = "";

    var switchery = {};
    $.fn.initComponents = function () {
        //Init CheckBox Style
        var searchBy = ".js-switch";
        $(this).find(searchBy).each(function (i, html) {
            //debugger;
            if (!$(html).next().hasClass("switchery")) {
                switchery[html.getAttribute('id')] = new Switchery(html, $(html).data());
            }
        });
    };

    $(document).ready(function(){
        $("body").initComponents();

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
            general_my_editing_single = general_my_editing[product_index];

            //console.log( selected_product );
            //return false;

            $(".loader").show();
            $.ajax({
                type: "POST",
                dataType:'html',
                data: {
                    selected_product: selected_product,
                    selected_editing: selected_editing,
                    general_my_editing_single: general_my_editing_single,
                    _token: _token
                },
                url: "{{$domain_name}}/printful/getProductDetails_popup_edit",
                async: true,
                success: function(data) {
                    $(".addProductDetails").html(data);
                    $(".loader").hide();
                    $("#product_details_modal").modal("show");
                }
            })
        });

        $(document).off("click",".add_field_icon").on("click",".add_field_icon", function(event){
            event.stopPropagation();
            var itemorgroup_id = $(this).attr("id");
            console.log("itemorgroup_id", itemorgroup_id);

            var json_fields = $(this).attr("json_fields");
            $(".table_fields").html("");
            if( json_fields != "" )
            {
                json_fields = JSON.parse(json_fields);
                console.log("json_fields", json_fields);
                $.each(json_fields, function(index, value){
                    console.log("value", value);
                    var newRow = $("<tr>");
                    var cols = '';
                    //alert(value['field_type']);
                    // Table columns
                    cols += '<th scrope="row" style="vertical-align: middle;">' + (parseInt(index)+1) + '</th>';
                    cols += '<td><input class="form-control fieldname" type="text" name="fieldname" placeholder="Field name" value="'+value['field_name']+'"></td>';
                    cols += '<td>'+
                        '<select class="form-control fieldtype" name="fieldtype">'+
                            '<option value=""> Select Type</option>';
                            if(value['field_type']=="text")
                            {
                                cols+= '<option value="text" selected> Text</option><option value="number">Number</option><option value="file">File</option><option value="url">URL</option>';
                            }
                            if(value['field_type']=="file")
                            {
                                cols+= '<option value="text"> Text</option><option value="number">Number</option><option value="file" selected>File</option><option value="url">URL</option>';
                            }
                            if(value['field_type']=="number"){
                                cols+= '<option value="text"> Text</option><option value="number" selected>Number</option><option value="file">File</option><option value="url">URL</option>';
                            }
                            if(value['field_type']=="url")
                            {
                                cols+= '<option value="text"> Text</option><option value="number">Number</option><option value="file">File</option><option value="url" selected>URL</option>';
                            }
                            cols += '</select>'+
                    '</td>';
                    cols += '<td style="vertical-align: middle;"><input class="form-control field_required" type="checkbox" '+( (value['ischecked']==true)?"checked":"" )+' name="field_required" style="margin: auto;width: 22px;height: 22px;"></td>';
                    cols += '<td style="text-align: center;vertical-align: middle;"><button class="btn btn-danger" id ="deleteRow" style="padding: 10px;height: 40px;margin: auto;"><i class="fa fa-trash"></i></button</td>';
                    // Insert the columns inside a row
                    newRow.append(cols);

                    // Insert the row inside a table
                    $(".table_fields").append(newRow);

                });


            }



            $(".savefields_item").attr("id", itemorgroup_id)
            $('#addfields_modal').modal('show');
        });

        // Start counting from the third row
        var counter = 1;
        $("#insertRow").on("click", function (event) {
            event.preventDefault();

            var newRow = $("<tr>");
            var cols = '';

            // Table columns
            cols += '<th scrope="row" style="vertical-align: middle;">' + counter + '</th>';
            cols += '<td><input class="form-control fieldname" type="text" name="fieldname" placeholder="Field name"></td>';
            cols += `<td>
                <select class="form-control fieldtype" name="fieldtype">
                    <option value=""> Slect Type</option>
                    <option value="text"> Text</option>
                    <option value="number">Number</option>
                    <option value="file">File</option>
                    <option value="url">URL</option>
                </select>
            </td>`;
            cols += '<td style="vertical-align: middle;"><input class="form-control field_required" type="checkbox" name="field_required" style="margin: auto;width: 22px;height: 22px;"></td>';
            cols += '<td style="text-align: center;vertical-align: middle;"><button class="btn btn-danger" id ="deleteRow" style="padding: 10px;height: 40px;margin: auto;"><i class="fa fa-trash"></i></button</td>';

            // Insert the columns inside a row
            newRow.append(cols);

            // Insert the row inside a table
            $(".table_fields").append(newRow);

            // Increase counter after each row insertion
            counter++;
        });

        // Remove row when delete btn is clicked
        $("table").on("click", "#deleteRow", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });

        // Save fields into items DOM
        $(".savefields_item").on("click", function(){
            var id = $(this).attr("id");
            var main_obj = {};
            $(".table_fields tr").each(function(index, value){
                var inner_obj = {};
                var field_name = $(this).find(".fieldname:first").val();
                var field_type = $(this).find(".fieldtype:first").val();
                var  ischecked = $(this).find(".field_required:first").is(":checked");
                inner_obj["field_name"] = field_name;
                inner_obj["field_type"] = field_type;
                inner_obj["ischecked"] = ischecked;
                main_obj[index] = inner_obj;
            });

            console.log( main_obj );
            $('.add_field_icon[id="'+id+'"]').attr("json_fields", JSON.stringify(main_obj) );
            $('#addfields_modal').modal('hide');
        });

        $(".closeLeftMenu").on("click", function(){
            $(".leftmenubar").css("left","-600px");
        });
        $(".menubars").on("click", function(){
            $(".leftmenubar").css("left","0px");
        });

        $(".left-menu-item").on("click", function(){
            $(this).next(".settings_container").toggle();
        });

        $(document).on("change",".dropzone", function(e){
            //readFile(this);
        });
        $(document).on("dragover",".dropzone-wrapper", function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });
        $(document).on("dragleave",".dropzone-wrapper", function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        window.image_path = "{{url('/')}}"+"/Image/"+"{{Auth::user()->id_company}}";
        function readURL_gallery(input) {
            if (input.files && input.files[0]) {

                var myimage = $(input).prop("files")[0];
                var fd = new FormData();
                fd.append("myimage", myimage);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/uploadimage",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            $(".mygallery_container").append(`<div class='col-md-3 gallery_image_view_con' style='position:relative;'>
                                                                    <i class="fa fa-trash delete_galleryimage_icon" aria-hidden="true" filename="`+data.filename+`"></i>
                                                                    <img class='gallery_image_view' src='`+image_path+`/`+data.filename+`' /> <br />
                                                                </div>`);
                            Swal.fire({
                            title: '<strong class="proof_popup_title">Your image has been uploaded successfully!</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;"></p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                    //location.reload();
                                    }
                                })

                        }
                    }
                });
            }
        }
        $("#gallery").change(function(){
            readURL_gallery(this);
        });

        function readURL_slider_image(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $(input).parents(".slider_wrapper:first").css("border","");
                reader.onload = function (e) {
                    var index = $(input).attr("index");
                    console.log("index", index);
                    $(".slider .carousel-inner").find(".carousel-item:eq("+index+") img").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on("change",".slider_image", function(){
            readURL_slider_image(this);
        });

        function readURL_banner_image(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $(input).parents(".banner_wrapper:first").css("border","");
                reader.onload = function (e) {
                    $("img.banner_image_view").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on("change","#banner_image", function(){
            readURL_banner_image(this);
        });

        function readURL_banneroverlay_image(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                $(input).parents(".banneroverlay_wrapper:first").css("border","");
                reader.onload = function (e) {
                    $("div.overlay").css('background-image', "url("+e.target.result+")");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on("change","#banneroverlay_image", function(){
            readURL_banneroverlay_image(this);
        });

        $(document).on("keyup", ".instagram_text", function(){
            $("a.instagram").attr("href", $(this).val());
        });
        $(document).on("keyup", ".snapchat_text", function(){
            $("a.snapchat").attr("href", $(this).val());
        });
        $(document).on("keyup", ".twitter_text", function(){
            $("a.twitter").attr("href", $(this).val());
        });
        $(document).on("keyup", ".facebook_text", function(){
            $("a.facebook").attr("href", $(this).val());
        });
        $(document).on("keyup", ".company_name", function(){
            $(".company_name_label").text($(this).val());
        });

        $(document).on("keyup", ".title", function(){
            var index = $(this).attr("index");
            $(".slider .carousel-inner").find(".carousel-item:eq("+index+") .carousel-caption h3").text($(this).val());
        });
        $(document).on("keyup", ".description", function(){
            var index = $(this).attr("index");
            $(".slider .carousel-inner").find(".carousel-item:eq("+index+") .carousel-caption p").text($(this).val());
        });

        $(document).on("input",".bg_color, .bg_color2", function(event) {
            $(".bg_header").css("background-color",$(this).val());
            $(".bg_color").val($(this).val());
            $(".bg_color2").val($(this).val());
        });
        $(document).on("input",".cart_color, .cart_color2", function(event) {
            $(".cart_header").css("color",$(this).val());
            $(".cart_color").val($(this).val());
            $(".cart_color2").val($(this).val());
        });
        $(document).on("input",".caption_color, .caption_color2", function(event) {
            $(".carousel-caption h3").css("color",$(this).val());
            $(".carousel-caption p").css("color",$(this).val());

            $(".caption_color").val($(this).val());
            $(".caption_color2").val($(this).val());
        });
        function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
        }
        $(document).on("input",".caption_bg_color, .caption_bg_color2", function(event) {
            var rgb = hexToRgb($(this).val());
            console.log(rgb);
            $(".carousel-caption").css("background-color","rgb("+rgb.r+" "+rgb.g+" "+rgb.b+" / 79%)");
            $(".caption_bg_color").val($(this).val());
            $(".caption_bg_color2").val($(this).val());
        });
        $(document).on("input",".banner_bg_color, .banner_bg_color2", function(event) {
            $(".banner_bg_color_view").css("background-color",$(this).val());
            $(".banner_bg_color").val($(this).val());
            $(".banner_bg_color2").val($(this).val());
        });
        $(document).on("input",".banner_text_color, .banner_text_color2", function(event) {
            $(".banner_heading_view").css("color",$(this).val());
            $(".banner_description_view").css("color",$(this).val());
            $(".banner_text_color").val($(this).val());
            $(".banner_text_color2").val($(this).val());
        });
        $(document).on("input",".banner_cta_bg_color, .banner_cta_bg_color2", function(event) {
            $(".banner_button_view").css("background-color",$(this).val());
            $(".banner_cta_bg_color").val($(this).val());
            $(".banner_cta_bg_color2").val($(this).val());
        });
        $(document).on("input",".footer_bg_color, .footer_bg_color2", function(event) {
            $(".footer-basic").css("background-color",$(this).val());
            $(".footer_bg_color").val($(this).val());
            $(".footer_bg_color2").val($(this).val());
        });
        $(document).on("input",".footer_icon_color, .footer_icon_color2", function(event) {
            $(".footer-basic .icon").css("color",$(this).val());
            $(".footer_icon_color").val($(this).val());
            $(".footer_icon_color2").val($(this).val());
        });
        $(document).on("input",".footer_text_color, .footer_text_color2", function(event) {
            $(".copyright").css("color",$(this).val());
            $(".footer_text_color").val($(this).val());
            $(".footer_text_color2").val($(this).val());
        });






        $("#chk_1").change(function(){
            if($(this).is(":checked"))
            {
                $(".slider").show();
            }else{
                $(".slider").hide();
            }
        });

        $("#sticky_header").change(function(){
            if($(this).is(":checked"))
            {
                $("header").addClass("fixed-top");
                $("header").after('<div class="extra_space" style="height:82px;"></div>');
            }else{
                $("header").removeClass("fixed-top");
                $(".extra_space").remove();
            }
        });

        $("#chk_2").change(function(){
            if($(this).is(":checked"))
            {
                $(".banner").show();
            }else{
                $(".banner").hide();
            }
            //alert( $(this).is(":checked") );
        });

        $(document).on("click",".addslide", function(){
            var slide_no = $(".slider_container .slide").length;
            var slide = `<div class="form-group slide slide`+(slide_no+1)+`">
                            <span class="close" index="`+(slide_no+1)+`">&times;</span>
                            <label class="control-label title_label">Slide`+(slide_no+1)+` Title</label>
                            <input type="text" class="form-control title" index="`+slide_no+`" value="What is Lorem Ipsum" />
                            <br>
                            <label class="control-label description_label">Slide`+(slide_no+1)+` Description</label>
                            <input type="text" class="form-control description" index="`+slide_no+`" value="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries," />
                            <br>
                            <label class="control-label image_label">Slide`+(slide_no+1)+` Image</label>
                            <div style="position:relative;">
                            <input type="text" class="form-control changeimageonblur" name="slider`+(slide_no+1)+`_path" id="slider3_path" placeholder="https://Slider_image_path.com/" value="https://blinkswag.com/img/cms/blinkswag_swag_header.jpg">
                            <div class="selectfromgallery" attr_id="slider`+(slide_no+1)+`_path" data-toggle="modal" data-target="#galleryModal" style="top: -25px;"><i class="ni ni-image"></i></div>
                            </div>
                        </div>`;
            $(".slider_container").append(slide);
            $(".carousel-indicators").append(`<li data-target="#myCarousel" data-slide-to="`+slide_no+`"></li>`);
            $(".carousel-inner").append(`<div class="carousel-item">
                    <img class="d-block w-100" id="slider`+(slide_no+1)+`_path_view" src="https://blinkswag.com/img/cms/blinkswag_swag_header.jpg" alt="Image">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>What is Lorem Ipsum?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    </div>
                </div>`);

                $(".carousel-inner .carousel-item:first").addClass("active");
                $(".carousel-indicators button:first").addClass("active");
        });

        $(document).on("click","span.close",function(){
            var index = $(this).attr("index");
            $(this).parents(".slide:first").remove();
            $(".carousel-indicators li:eq("+(index-1)+")").remove();
            $(".carousel-inner .carousel-item:eq("+(index-1)+")").remove();
            $(".carousel-inner .carousel-item:first").addClass("active");

            $(".carousel-indicators li").each(function(index, value){
                $(this).attr("data-bs-slide-to", index);
                $(this).attr("aria-label", "Slide "+(index+1));
            });
            $(".carousel-indicators li:first").addClass("active");

            $(".slider_container .slide").each(function(index, value){
                $(this).removeAttr("class");
                $(this).addClass("form-group slide slide"+(index+1));
                $(this).find(".close").attr("index", (index+1));
                $(this).find(".title:first, .description:first, .slider_image:first").attr("index",index);

                $(this).find(".title_label:first").text("Slide "+(index+1)+" Title");
                $(this).find(".description_label:first").text("Slide "+(index+1)+" Description");
                $(this).find(".image_label:first").text("Slide "+(index+1)+" Image");
                $(this).find(".changeimageonblur:first").attr("name", "Slider"+(index+1)+"_path").attr("id", "Slider"+(index+1)+"_path");
                $(this).find(".selectfromgallery:first").attr("attr_id", "Slider"+(index+1)+"_path");

                $("#myCarousel .carousel-inner .carousel-item:eq("+index+")").find("img:first").attr("id", "Slider"+(index+1)+"_path_view")
            });

        });

        $(document).on("keyup", ".banner_heading", function(){
            $(".banner_heading_view").text($(this).val());
        });
        $(document).on("keyup", ".banner_description", function(){
            $(".banner_description_view").text($(this).val());
        });
        $(document).on("keyup", ".banner_cta_text", function(){
            $(".banner_button_view").text($(this).val());
        });

        $(document).on("click", ".gallery_image_view_con", function(e){
            $(".gallery_image_view_con.active").removeClass("active");
            $(this).addClass("active");
        });
        $(document).on("click", ".delete_galleryimage_icon", function(e){
            var that = $(this);
            var filename = $(this).attr("filename");
            //alert( filename );
                var fd = new FormData();
                fd.append("filename", filename);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/deleteuploadimage",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            $(that).parent().remove();
                            Swal.fire({
                            title: '<strong class="proof_popup_title">Your image has been Deleted successfully!</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;"></p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                    //location.reload();
                                    }
                                })

                        }
                    }
                });
        });


        $(document).on("click", ".addimage", function(e){
            if( $(".gallery_image_view_con.active").length == 0)
            {
                alertify.error("Please Select the image first.");
                return false;
            }
            var imagepath = $(".gallery_image_view_con.active").find("img.gallery_image_view").attr("src");
            $("#"+$(this).attr("id_catch")).val(imagepath);

            if($(this).attr("id_catch")=="banner_overlay_path")
            {
                $("#"+$(this).attr("id_catch")+"_view").css("background-image", "url("+imagepath+")");
            }else{
                $("#"+$(this).attr("id_catch")+"_view").attr("src", imagepath);
            }
            $("#galleryModal").modal("hide");
        });
        $(document).on("click", ".selectfromgallery", function(e){
            $(".addimage").attr("id_catch", $(this).attr("attr_id"));
            $(".gallery_image_view_con.active").removeClass("active");
        });
        $(document).on("blur", ".changeimageonblur", function(e){
            if($(this).attr("id")=="banner_overlay_path")
            {
                $("#"+$(this).attr("id")+"_view").css("background-image", "url('"+$(this).val()+"')");
            }else{
                $("#"+$(this).attr("id")+"_view").attr("src", $(this).val());
            }
        });

        $(document).on("click", ".savestore", function(e){
            $(".loader").show();

            var complete_settings = new Object();
            // products
            var item_ids = new Object();
            var item_json_fields = new Object();
            var counter = 0;
            $('#selectproductsModal input[type=checkbox]').not(".field_required").each(function () {
                if(this.checked)
                {
                    item_ids[counter] = $(this).val();
                    counter++;
                    item_json_fields[$(this).attr("id")] = $(this).parent().find(".add_field_icon:first").attr("json_fields");
                }
            });

            //Header Settings
            var header_settings = new Object();
            header_settings['header_sticky'] = $("#sticky_header").is(":checked");
            header_settings['logo_path'] = $("#logo_path").val();
            header_settings['header_bg_color'] = $(".bg_color2").val();
            header_settings['cart_icon_color'] = $(".cart_color2").val();
            complete_settings['header'] = header_settings;

            //Slider Settings
            var slider_settings = new Object();
            slider_settings['show_sider'] = $("#chk_1").is(":checked");
            slider_settings['caption_color'] =  $(".caption_color2").val();
            slider_settings['caption_bg_color'] =  $(".caption_bg_color2").val();
            var slider = new Object();
            $(".slider_container .slide").each(function(index, value){
                var slide = new Object();
                slide['title'] = $(this).find(".title:first").val();
                slide['description'] = $(this).find(".description:first").val();
                slide['image_path'] = String($(this).find(".changeimageonblur:first").val());
                slider[index] = slide;
            });
            slider_settings['slides'] =  slider;
            complete_settings['slider'] = slider_settings;

            //Banner Settings
            var banner_settings = new Object();
            banner_settings['show_banner'] = $("#chk_2").is(":checked");
            banner_settings['banner_heading'] = $(".banner_heading").val();
            banner_settings['banner_description'] = $(".banner_description").val();
            banner_settings['banner_cta_text'] = $(".banner_cta_text").val();
            banner_settings['banner_path'] = $("#banner_path").val();
            banner_settings['banner_overlay_path'] = $("#banner_overlay_path").val();
            banner_settings['banner_bg_color2'] = $(".banner_bg_color2").val();
            banner_settings['banner_text_color2'] = $(".banner_text_color2").val();
            banner_settings['banner_cta_bg_color2'] = $(".banner_cta_bg_color2").val();
            complete_settings['banner'] = banner_settings;

            //footer Settings
            var footer_settings = new Object();
            footer_settings['instagram_text'] = $(".instagram_text").val();
            footer_settings['snapchat_text'] = $(".snapchat_text").val();
            footer_settings['twitter_text']  = $(".twitter_text").val();
            footer_settings['facebook_text'] = $(".facebook_text").val();
            footer_settings['company_name'] = $(".company_name").val();
            footer_settings['footer_bg_color2'] = $(".footer_bg_color2").val();
            footer_settings['footer_icon_color2'] = $(".footer_icon_color2").val();
            footer_settings['footer_text_color2'] = $(".footer_text_color2").val();
            complete_settings['footer'] = footer_settings;

            //Selected products and fields json
            complete_settings['item_ids'] = item_ids;
            complete_settings['item_json_fields'] = item_json_fields;

            console.log("complete_settings", complete_settings);
            var fd = new FormData();
                fd.append("store_id", $(this).attr("store_id"));
                fd.append("complete_settings", JSON.stringify(complete_settings));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/updatestore",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            $(".loader").hide();
                            Swal.fire({
                            title: '<strong class="proof_popup_title">Your store has been updated successfully!</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;"></p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                    //location.reload();
                                    }
                                })

                        }
                    }
                });



        });

        $(document).on("click",".closeproductspopup", function(){
            $(".products_container_selected").html("");
            $('#selectproductsModal input[type=checkbox]').not(".field_required").each(function () {
                if(this.checked)
                {
                    var clone = $(this).next().clone();

                    $(".products_container_selected").append(clone);
                }
            });
            $(".products_container_selected").find("label").addClass("col-md-4");
        });

        $(".closeproductspopup").trigger("click");




    });
</script>
@endsection


@push('js')
    <script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.extension.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
