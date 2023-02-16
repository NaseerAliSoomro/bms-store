@extends('layouts.app')

@section('content')

@php
    $domain_name = '';
    if($_SERVER['SERVER_NAME']=="localhost")
    {
        // $domain_name = "/dashboard";
    $domain_name = "/blinkswag-dashboard";

    }

    //dd( $product_details );
    //dd( $product_details['product']['title'] );
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
    .design_layout {
        position: absolute;
        width: 100%;
    }

</style>


<div id="overlay" style="display:none;">
    {{-- naseer --}}
 {{-- <img  src="{{asset('public/assets/img/blinkswag_loader.gif')}}" alt="" class="spinner1"> --}}
 <img  src="{{env('APP_URL')}}/public/assets/img/blinkswag_loader.gif" alt="" class="spinner1">
</div>

	<div class="row">
        <div class="col-md-12 design_mockup_container">
            <ul class="nav nav-tabs mockup_tabs">
                <?php
                $isactive = "active";
                ?>
                @foreach($product_details['product']['files'] as $key=>$placement)
                    @if($placement['type']!="mockup" && $placement['type']!="embroidery_chest_left" && $placement['type']!="embroidery_chest_center" )
                    <li class="nav-item">
                        <a class="nav-link {{$isactive}}" id="design_layout_{{$placement['type']}}-tab" data-toggle="tab" href="#design_layout_{{$placement['type']}}" role="tab" aria-selected="true">{{$placement['title']}}</a>
                    </li>
                    <?php
                        $isactive="";
                    ?>
                    @endif
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
            <?php
                $isactive = "active";
                ?>
                @foreach($product_details['product']['files'] as $key=>$placement)
                    @if( $placement['type']!="mockup" && $placement['type']!="embroidery_chest_left" && $placement['type']!="embroidery_chest_center" )
                        <div class="tab-pane fade show m-3 {{$isactive}}" id="design_layout_{{$placement['type']}}" role="tabpanel" aria-labelledby="design_layout_{{$placement['type']}}-tab">
                            {{$placement['type']}}

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
                                <input  type="file" name="gallery" id="" value="" accept="image/*"  class="dropzone gallery" filename="{{$placement['type']}}">
                            </div>

                            <div class="shirtDiv_{{$placement['type']}}" class="page"
                                style="width: 530px; height: 530px; position: relative; background-color: rgb(255, 255, 255);">
                                <img class="js-qv-product-cover card-img-top product_image"  alt="Card image cap">
                            </div>
                        </div>
                        <?php
                            $isactive="";
                        ?>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <a class="nav-link btn btn-default saveproduct" style="color: white !important;">Save</a>
        </div>
    </div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.css">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
 <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.js"></script>

 <script>
var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function(){
    //wsmemon
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

        window.image_path = "{{url('/')}}"+"/Image/Transparent Images/"+"{{$product_id}}";
        function readURL_gallery(input) {
            if (input.files && input.files[0]) {

                var myimage = $(input).prop("files")[0];
                var filename = $(input).attr("filename");

                var fd = new FormData();
                fd.append("myimage", myimage);
                fd.append("product_id", "{{$product_id}}");
                fd.append("filename", filename);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/uploadimage_printful",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                           if($(input).parents(".dropzone-wrapper:first").next().find(".jcrop-holder").length>0)
                           {
                                $(input).parents(".dropzone-wrapper:first").next().find("img.product_image:first").data("Jcrop").destroy();
                           }

                            $(input).parents(".dropzone-wrapper:first").next().find("img.product_image:first").attr("src",image_path+`/`+data.filename);
                            $(input).parents(".dropzone-wrapper:first").next().find("img.product_image:first").Jcrop({
                                onSelect: function(c){
                                    console.log(c);
                                    $("img.product_image:visible").attr("inner_canvas", JSON.stringify(c));

                                    console.log(c.x);
                                    console.log(c.y);
                                    console.log(c.w);
                                    console.log(c.h);
                                }
                            },function(){
                                $(".jcrop-holder").css("background-color","white");
                                } );



                        }
                    }
                });
            }
        }
        $(".gallery").change(function(){
            readURL_gallery(this);
        });
        $(document).on("click", ".saveproduct", function(e){
            var complete_json = {};
            $(".jcrop-holder img.js-qv-product-cover.product_image").each(function(index, value){
                var src = $(value).attr("src");
                var inner_canvas = $(value).attr("inner_canvas");
                var arr1 = {};
                arr1['src'] = src;
                arr1['inner_canvas'] = inner_canvas;
                complete_json[index] = arr1;
            });
            console.log("complete_json", complete_json);
            var product_id = "{{$product_id}}";
            console.log("product_id", product_id);
            var fd = new FormData();
            fd.append( "product_id", product_id );
            fd.append("title", "{{$product_details['product']['title']}}")
            fd.append( "complete_json", JSON.stringify(complete_json) );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{$domain_name}}/save_printful_product",
                type: "POST",
                data:fd,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                   // data = JSON.parse(data);
                    if(data.status=="success")
                    {
                        Swal.fire({
                            title: '<strong class="proof_popup_title">Product Edit</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;">Your Product has been Saved with all placements.</p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                     window.location = "{{$domain_name}}/view_uploaded_products"
                                    }
                            })
                    }
                }
            });
        });

});

window.product_details = @json($product_details);
console.log("product_details", product_details);

</script>
@endsection
