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
<style>
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
</style>
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

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

<!--Modal-->
<!-- Modal -->
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
        });
    </script>

@endsection

@push('js')
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
