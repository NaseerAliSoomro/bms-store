@php
$domain_name = '';
if($_SERVER['SERVER_NAME']=="localhost")
{
    // $domain_name = "/dashboard";
    $domain_name = "/blinkswag-dashboard";
}

@endphp

<?php
//echo 'waqas';
//dd( count($stores) );
?>
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 20%;
  height: auto;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 80%;
  border-left: none;
  /* height: 300px; */
}

.delete_store_icon
    {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }
    .delete_store_icon:hover
    {
        color:#a60000;
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
    margin-right: -15px;
}
</style>

@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="row">
    <div class="tab">
        <button class="tablinks" onclick="openView(event, 'Productlist')" id="defaultOpen">Product List</button>
        <button class="tablinks" onclick="openView(event, 'Stores')">Stores</button>
    </div>

    <div id="Productlist" class="tabcontent">
        <div class="row m-5">
            <h3>Product List</h3>
{{-- <img src="{{ ('public/assets/img/150.png') }}" alt="Image"> --}}
            <div class="row m-2">
                <div class="card col-md-5 my-1" style="align-items: center;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%); padding:20px;">
                    <div class="card-header" style="display:inline;">
                    </div>
                    <!-- <i class="ni ni-shop" style="font-size: 100px;"></i> -->
                    {{-- naseer --}}
                    {{-- <img src="{{('public/assets/img/shirst_logo.svg')}}" style="width: 100px;height: 100px;" alt=""> --}}
                    <img src="{{env('APP_URL')}}/public/assets/img/shirst_logo.svg" style="width: 100px;height: 100px;" alt="">

                    <div class="card-body">
                        <p style="margin-top: -1em;"  class="card-text">Design products and sell on your own online store. We do the printing and shipping. FREE Forever!</p>
                    </div>
                    <div class="card-footer" style="margin: auto;">
                       <a href="{{env('APP_URL')}}/product/printful">
                            <button class="btn btn-default nav-link" style="float: right;color:#fff; cursor:pointer;">Design Products</button>
                        </a>
                    </div>
                </div>

                <div class="card col-md-5 my-1" style="align-items: center;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%); padding:20px;">
                    <div class="card-header" style="display:inline;">
                    </div>
                    <!-- <i class="ni ni-shop" style="font-size: 100px;"></i> -->
                    {{-- naseer --}}
                    {{-- <img src="{{('public/assets/img/shirst_logo.svg')}}" style="width: 100px;height: 100px;" alt=""> --}}
                    <img src="{{env('APP_URL')}}/public/assets/img/shirst_logo.svg" style="width: 100px;height: 100px;" alt="">

                    <div class="card-body">
                        <p style="margin-top: -1em;"  class="card-text">Design products and sell on your own online store. We do the printing and shipping. FREE Forever!</p>
                    </div>
                    <div class="card-footer" style="margin: auto;">
                       <a href="{{env('APP_URL')}}/product/editor">
                            <button class="btn btn-default nav-link" style="float: right;color:#fff; cursor:pointer;">Inventory Products</button>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="table-responsive">
            <h1 class="text-default" style="margin-bottom: 50px;">All Products</h1>
            <table class="table align-items-center" id="salesorder">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">#</th>
                        <th scope="col" class="sort" data-sort="status">Product</th>
                        <th scope="col">Selected Sizes</th>
                        <th scope="col" class="sort" data-sort="budget">Slected Colors</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach( $Product_List as $key1=>$product)
                        @php
                        $product_decode = json_decode($product->product, true);
                        $selected_variants = json_decode($product->selected_variants, true);

                        $color_html = "";
                        $colors = [];
                        $sizes = [];
                        foreach( $selected_variants as $key=>$variant)
                        {
                            if( !in_array($variant['size'], $sizes) )
                            {
                                array_push($sizes, $variant['size']);
                            }
                            if( !in_array($variant['color'], $colors) )
                            {
                                $color_html .='<input type="checkbox" class="checkbox-round" style="background-color:'.$variant['color_code'].';" />';
                                array_push($colors, $variant['color']);
                            }

                        }
                        @endphp
                        <tr>
                            <td scope="col" class="sort" data-sort="name">{{$key1+1}}</td>
                            <td scope="col" class="sort" data-sort="status">{{$product_decode['product']['title']}}</td>
                            <td scope="col">{{implode(", ",$sizes)}}</td>
                            <td scope="col" class="sort" data-sort="budget">
                                {!!$color_html!!}
                            </td>
                            <td scope="col"><a href="{{$domain_name}}/product/edit_product_list/{{$product->id}}">Add to Store</a> | <span class="delete_product_list" product_list_id="{{$product->id}}" style="cursor:pointer;color: #7777f1;">Delete</span></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @if( count($Product_List)==0 )
            <div class="row">
                <div class="col-xl-12 h2 text-center font-weight-400">
                    No Product yet.
                </div>
            </div>
            @endif
        </div>


    </div>

    <div id="Stores" class="tabcontent">
        <div class="row">
            <div class="col-11" style="margin: 20px;">
                <H3 style="float: left;margin:20px;" >All Stores</H3>
                <button class="btn btn-default nav-link" data-toggle="modal" data-target="#exampleModal" style="float: right;color:#fff; cursor:pointer;">Create store</button>
            </div>
        </div>

        <div class="row" id="row_append" style="margin: 20px;">
            @if(count($stores)>0)
                @foreach ($stores as $key =>  $store)
                <div class="card col-md-3 my-1" style="text-align: center; box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%); padding:20px;">

                    <i class="fa fa-trash delete_store_icon" aria-hidden="true" id="{{$store->id}}"></i>

                    <div class="card-header" style="display:inline;">
                    </div>
                    <i class="ni ni-shop" style="font-size: 100px;"></i>
                    <div class="card-body">
                        <h4 class="card-title">{{ $store->name }}</h4>
                        <p style="margin-top: -1em;"  class="card-text">{{ $store->description }}</p>
                    </div>
                    <div class="card-footer" style="margin: auto;">
                        {{-- naseer --}}
                        {{-- <a href="{{url('/editstore', $store->id)}}"  class="text-primary">Edit Store</a> --}}
                        <a href="{{env('APP_URL')}}/editstore/{{$store->id}}"  class="text-primary">Edit Store</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <i class="ni ni-shop" style="font-size: 100px;color: gainsboro;"></i>
                    <h1> You have no store yet. </h1>
                </div>
            @endif
        </div>
    </div>
</div>

<!--Create store modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{$domain_name}}/create_store" method="POST">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Store Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Store Name</label>
                    <input type="text" name="name" id="email" class="form-control" required="">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Create store modal-->

<!--Design product modal-->
<div class="modal fade" id="designProductsModal" tabindex="-1" role="dialog" aria-labelledby="designProductsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p>Back</p>
            </div>
            <div class="modal-body">
                <h1>Select Product to design</h1>
                <p>Modal body text goes here.</p>
            </div>
        </div>
    </div>
</div>
<!--Design product modal-->

<div class="addProductDetails">

</div>

    <script type="text/javascript">
        $(document).ready(function(){

            let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $(document).on("click", ".delete_store_icon", function(e){
                var id = $(this).attr("id");
                console.log("id", id);
                $.ajax({
                            type: "POST",
                            data: {
                                id: id,
                                _token: _token
                            },
                            url: "{{$domain_name}}/deletestore",
                            async: false,
                            success: function(data) {
                                data = JSON.parse(data);
                                if(data.status=="success")
                                {
                                    Swal.fire({
                                    title: '<strong class="proof_popup_title">Your store has been Deleted!</strong>',
                                    icon: 'success',
                                    html: ' <p style="text-align: center;"></p>',
                                    confirmButtonText: 'Okay',
                                    allowOutsideClick: true,
                                    showCloseButton: false,
                                    allowOutsideClick: false,
                                    }).then((result) => {
                                            if (result.isConfirmed) {
                                            location.reload();
                                            }
                                        })
                                    }
                                }
                        });
            });

            $(document).on("click",".delete_product_list", function(event){
                var product_list_id = $(this).attr("product_list_id");
                //alert(product_list_id);
                $.ajax({
                    type: "POST",
                    data: {
                        id: product_list_id,
                        _token: _token
                    },
                    url: "{{$domain_name}}/deleteproductlist",
                    async: true,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            Swal.fire({
                            title: '<strong class="proof_popup_title">Your Product has been Deleted!</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;"></p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                     location.reload();
                                    }
                            })
                        }
                    }
                });
            });

            $(document).on("click",".edit_product_list", function(event){
                var product_list_id = $(this).attr("product_list_id");
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    dataType:'html',
                    data: {
                        product_list_id: product_list_id,
                        _token: _token
                    },
                    url: "{{$domain_name}}/printful/getProductDetails_edit",
                    async: true,
                    success: function(data) {
                        $(".addProductDetails").html(data);
                        $(".loader").hide();
                        $('.selectpicker').selectpicker();
                        $("#product_details_modal").modal("show");
                    }
                })
            });
        });

        function addtostore(elem)
            {
                var product_id = $(elem).attr("product_id");
                console.log("product_id", product_id);
            }
    </script>


@endsection

@push('js')
<script>
    function openView(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
</script>
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endpush
