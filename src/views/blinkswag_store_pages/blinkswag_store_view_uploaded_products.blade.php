@extends('layouts.app')

@section('content')

@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
        $domain_name = "/blinkswag-dashboard";

    }

    //dd( $printful_transparent_images );
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>

</style>


<div id="overlay" style="display:none;">
    {{-- naseer --}}
 {{-- <img  src="{{env('public/assets/img/blinkswag_loader.gif')}}" alt="" class="spinner1"> --}}
 <img  src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" alt="" class="spinner1">
</div>



    <div class="row m-3">
        <div class="col-md-12">
        <table class="table align-items-center" id="salesorder">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Product images</th>
                    <th scope="col">Product Mockup areas</th>
                </tr>
            </thead>
            <tbody class="list">
                @php
                    $counter = 1;
                @endphp
                @foreach ($printful_transparent_images as $printful_transparent_image)
                    @php
                    $images = json_decode($printful_transparent_image->images_json, true);
                    //dd( $images );
                    @endphp
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{$printful_transparent_image->product_id}}</td>
                        <td>{{$printful_transparent_image->title}}</td>
                        <td>
                            @foreach($images as $k=>$image)
                                <img src="{{$image['src']}}" width="50" height="50" >
                            @endforeach
                        </td>
                        <td>
                            @foreach($images as $k=>$image)
                                {{$image['inner_canvas']}}
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
 <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
 <script>
var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function(){
    //wsmemon

    //wsmemon
});
</script>
@endsection
