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
//dd( $Product_List->mockups_images=="" );
//dd($Product['product']['id']);
$images_json = [];
$inner_canvas_arr = [];
if($ismockups)
{
    $images_json = json_decode($printful_transparent_images->images_json, true);
    foreach($images_json as $key=>$image)
    {
        $inner_canvas = json_decode($image['inner_canvas'], true);
        array_push($inner_canvas_arr, $inner_canvas);
    }
}

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

.design_container
{
    position: absolute;
    width: 170px;
    height: 230px;
    touch-action: none;
    user-select: none;
    border: 1px dotted red;
    display: block;
    top: 48%;
    left: 49%;
    transform: translate(-50%, -50%);
    margin: 0;
}
.design_layout_front,
.design_layout_back,
.design_layout_label_outside,
.design_layout_label_inside,
.design_layout_sleeve_left,
.design_layout_sleeve_right
{
    /* width: 728px;
    height: 728px; */
    display:none;
}

.grid_container
{
    width: 250px;
    height: 330px;
    position: absolute;
    top: 160px;
    left: 255px;
    border: 1px dotted red;
}

.color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }

        .rotate {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform: rotate(90deg);
        }

        .Arial {
            font-family: "Arial";
        }

        .Helvetica {
            font-family: "Helvetica";
        }

        .MyriadPro {
            font-family: "Myriad Pro";
        }

        .Delicious {
            font-family: "Delicious";
        }

        .Verdana {
            font-family: "Verdana";
        }

        .Georgia {
            font-family: "Georgia";
        }

        .Courier {
            font-family: "Courier";
        }

        .ComicSansMS {
            font-family: "Comic Sans MS";
        }

        .Impact {
            font-family: "Impact";
        }

        .Monaco {
            font-family: "Monaco";
        }

        .Optima {
            font-family: "Optima";
        }

        .HoeflerText {
            font-family: "Hoefler Text";
        }

        .Plaster {
            font-family: "Plaster";
        }

        .Engagement {
            font-family: "Engagement";
        }

        /* .img-polaroid {
            padding: 0;
            margin: 0;
            border: 2px solid transparent;
            max-height: 92px;
            max-width: 92px;
            min-height: 92px;
            min-width: 92px;

        }

        .img-polaroid:hover {
            cursor: pointer;
            border-color: #00a5f7;
        }

        .tt {
            margin-right: 4px;
        } */
        .well .nav input.checkbox-round {
            margin-right: 0;
        }

        .selectfromgallery {
        position: absolute;
        right: 200px;
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

    #test{
        width: 530px;
        height: 530px;
        /* position:absolute;
        z-index: 1;  */
        /* display:none; */
    }

    .design_mockup_container
    {
        position: relative;
        height: 600px;
        width: 100%;
    }
    .nb-spinner {
    width: 75px;
    height: 75px;
    margin: 10px;
    background: transparent;
    border-top: 4px solid #03A9F4;
    border-right: 4px solid transparent;
    border-radius: 50%;
    -webkit-animation: 1s spin linear infinite;
    animation: 1s spin linear infinite;
    /* float:left; */
    display:none;
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.canvas-container {
    border: 1px transparent dashed;
}
.canvas-container:hover {
    border: #878787 1px dashed;
}

</style>

    <?php
    //dd( json_decode($Product_List->selected_sizes) );
    $selected_size = "";
    //$selected_size = implode(", ", json_decode($Product_List->selected_sizes));
    //dd( $selected_size );
    $product_details = json_decode($Product_List->product, true);
    $selected_variants = json_decode($Product_List->selected_variants, true);
    //dd( $selected_variants );

    $color_html = "";
    $colors = [];
    $sizes = [];
    $variant_first = "";
    foreach( $selected_variants as $key=>$variant)
    {
        if($variant_first=="")
        {
            $variant_first = $variant['id'];
        }
        if( !in_array($variant['size'], $sizes) )
        {
            array_push($sizes, $variant['size']);
        }
        if( !in_array($variant['color'], $colors) )
        {
            $color_html .='<input type="checkbox" class="checkbox-round" color_code="'.$variant['color_code'].'" variant_id="'.$variant['id'].'" style="background-color:'.$variant['color_code'].';" />';
            array_push($colors, $variant['color']);
        }

    }
    ?>

    <input type="hidden" class="product_files" value="{{json_encode($Product['product']['files'], true)}}">

    <?php
    $dir = public_path('Image/'.Auth::user()->id_company.'/mockups\\/'.$Product_List->id.'/');
    //echo $dir;
    if (is_dir($dir)) {
        ?>
        <div class="row mt-3">
                <div class="col-md-6  mt-3 pr-6" ></div>
                <div class="col-md-6 mt-3 pr-6" style="text-align: right;color:green;"> Mockup is already designed. <i class="fas fa-palette"></i></div>
            </div>
        <?php
    }else{
        if($ismockups==1)
        {
            if($product_details['product']['type']=="T-SHIRT")
            {
                ?>
                <div class="row mt-3">
                    <div class="col-md-6  mt-3 pr-6" ></div>
                    <div class="col-md-6 edit_mockup mt-3 pr-6" style="text-align: right;cursor:pointer;">Design Mockup <i class="fas fa-palette"></i></div>
                </div>
                <?php
            }
        }
    }
    ?>

    <div class="col-md-12 design_mockup_container" style="display:block;">
        <ul class="nav nav-tabs mockup_tabs">
            @foreach($Product['product']['files'] as $key=>$placement)
                @if($placement['type']!="mockup" && $placement['type']!="embroidery_chest_left" && $placement['type']!="embroidery_chest_center" )
                <li class="nav-item">
                    <a class="nav-link {{($key==0)?'active':''}}" data-layout="design_layout_{{$placement['type']}}">{{$placement['title']}}</a>
                </li>
                @endif
            @endforeach
        </ul>

        <?php
        $counter = 0;
        ?>
        @foreach($Product['product']['files'] as $key=>$placement)
            @if( $placement['type']!="mockup" && $placement['type']!="embroidery_chest_left" && $placement['type']!="embroidery_chest_center" )
            <div class="design_layout design_layout_{{$placement['type']}}" style="display:block;">
                <!-- <img class="js-qv-product-cover card-img-top front_product_image" src="{{env('APP_URL')}}/Image/Transparent Images/{{$placement['type']}}.png" alt="Card image cap"> -->
                <!-- <div class="grid_container"></div> -->
                <section class="typography">
                    <!-- Headings & Paragraph Copy -->
                    <div class="row">
                        <div class="col-md-6">
                            <div align="center" style="min-height: 32px;">
                                <div class="clearfix">
                                    <div class="btn-group inline pull-left texteditor" class="" style="display:none">
                                        <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown"
                                                title="Font Style"><i class="icon-font" style="width:19px;height:19px;"></i>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                                            <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad
                                                    Pro</a></li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic
                                                    Sans MS</a></li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler
                                                    Text</a></li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a>
                                            </li>
                                            <li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a>
                                            </li>
                                        </ul>
                                        <button id="text-bold" class="btn" data-original-title="Bold"><img src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/img/font_bold.png"
                                                                                                        height="" width="">
                                        </button>
                                        <button id="text-italic" class="btn" data-original-title="Italic"><img
                                                    src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/img/font_italic.png" height="" width=""></button>
                                        <button id="text-strike" class="btn" title="Strike" style=""><img
                                                    src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/img/font_strikethrough.png" height="" width=""></button>
                                        <button id="text-underline" class="btn" title="Underline" style=""><img
                                                    src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/img/font_underline.png"></button>
                                        <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Color"><input
                                                    type="hidden" class="text-fontcolor" class="color-picker" size="7" value="#000000"></a>
                                        <a class="btn" href="#" rel="tooltip" data-placement="top"
                                        data-original-title="Font Border Color"><input type="hidden" class="text-strokecolor"
                                                                                        class="color-picker" size="7"
                                                                                        value="#000000"></a>
                                        <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                                    </div>
                                    <div class="pull-right imageeditor" align="" class="" style="display:none">
                                        <div class="btn-group">
                                            <button class="btn" id="bring-to-front" title="Bring to Front" style="display:none"></button>
                                            <button class="btn" id="send-to-back" title="Send to Back" style="display:none"></button>
                                            <button id="flip" type="button" class="btn" title="Show Back View" style="display:none"></button>
                                            <button id="remove-selected" class="btn remove-selected" title="Delete selected item"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--	EDITOR      -->
                            <div class="shirtDiv" class="page"
                                style="width: 530px; height: 530px; position: relative; background-color: rgb(255, 255, 255);">
                                <!--img id="tshirtFacing" src="img/crew_front.png"></img-->
                                <!-- <img id="tshirtFacing" src="img/t-shirts/crew_front.png"></img> -->
                                <img class="js-qv-product-cover card-img-top front_product_image" src="{{asset('APP_URL')}}/Image/Transparent Images/{{$Product['product']['id']}}/{{$placement['type']}}.png" alt="Card image cap">
                                {{-- <img class="js-qv-product-cover card-img-top front_product_image" src="{{env('APP_URL')}}/public/Image/Transparent Images/{{$Product['product']['id']}}/{{$placement['type']}}.png" alt="Card image cap"> --}}
                                <div class="drawingArea"
                                    style="position: absolute;top: {{$inner_canvas_arr[$counter]['y']}}px;left: {{$inner_canvas_arr[$counter]['x']}}px;z-index: 10;width: {{$inner_canvas_arr[$counter]['w']}}px;height: {{$inner_canvas_arr[$counter]['h']}}px;">
                                    <canvas id="tcanvas_{{$placement['type']}}" width="{{$inner_canvas_arr[$counter]['w']}}" height="{{$inner_canvas_arr[$counter]['h']}}" class="hover"
                                            style="-webkit-user-select: none;"></canvas>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mt-3 right_settings" style="display:none;">
                            <div class="well">
                                <ul class="nav">
                                    <h3>Color</h3>
                                        {!!$color_html!!}
                                </ul>
                            </div>

                            <hr>

                            <span>Text</span>
                            <input class="text-string" id="text-string_old" type="text" placeholder="Enter ...">
                            <button id="add-text" class="btn add-text" title="Add">Add</button>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Choose Image From Gallery</h4>
                                </div>
                                <div class="selectfromgallery" title="Select from Gallery" attr_id="logo_path" data-toggle="modal" data-target="#galleryModal"><i class="ni ni-image"></i></div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        <a class="imgsavejpg" attr-type="{{$placement['type']}}" style="cursor:pointer;">Save Mockup</a> &nbsp;&nbsp;&nbsp;
                                        <span class="download_mockup"><a class="download_mockup_a" style="display:none; cursor:pointer;">Download</a></span>
                                        <div class="nb-spinner"></div>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="editor"></div>
                </section>
            </div>
            <?php
            $counter++;
            ?>
            @endif
        @endforeach

        <!-- <span class="btn form-control btn-default save_mockup_design" style="position: absolute;right: 30px;top: 2px;width: 75px;">
            Save
        </span> -->
        <button type="button" class="close close_design" aria-label="Close" style="position: absolute;right: 10px;top: 10px;">
            <span aria-hidden="true">×</span>
        </button>
    </div>


    <div class="row mx-5 my-3 editor_layout">
        <div class="col-md-6 col-sm-6 hidden-xs-down single_image">
            <!-- <div class="design_container"></div> -->

            <div class="images-container">
                <?php
                    $flag = 0;
                    $dir = public_path('Image/'.Auth::user()->id_company.'/mockups\\/'.$Product_List->id.'/');
                    //echo $dir;
                    if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            while (($file = readdir($dh)) !== false) {
                                if($file!="." && $file!=".." && str_contains($file, $variant_first) )
                                {
                                    if($file=="front_".$variant_first.".png")
                                    {
                                        $class="active";
                                    }else{
                                        $class = "";
                                    }
                                    //echo $file."<br>";
                                    echo "<div class='col-md-3 gallery_image_view_con gallery_left ".$class."' style='position:relative;width:100px; height:100px;'>";
                                    echo "<img style='width: 100%;height: 100%;' class='gallery_image_view img-polaroid tt' src='".url('/').'/Image/'.Auth::user()->id_company.'/mockups/'.$Product_List->id.'/'.$file."' /> <br />";
                                    echo "</div>";

                                    if($file=="front_".$variant_first.".png")
                                    {
                                        $flag=1;
                                        ?>
                                        <img style="position: absolute;right: 0px;top: 0px;width: 80%;" class="js-qv-product-cover card-img-top modal_product_image" src="{{url('/')}}/Image/{{Auth::user()->id_company}}/mockups/{{$Product_List->id}}/{{$file}}" alt="Card image cap">
                                        <?php
                                    }
                                }
                            }
                            closedir($dh);
                        }
                    }

                if($flag!=1)
                {
                    ?>
                    <img style="position: absolute;right: 0px;top: 0px;" class="js-qv-product-cover card-img-top modal_product_image" src="{{$product_details['product']['image']}}" alt="Card image cap">
                    <?php
                }
                ?>
            </div>
        </div>

                <div class="col-md-6 col-sm-6">
                    <h3>Product Name</h3>
                    <input type="text" class="form-control product_name" value="{{$product_details['product']['title']}}">
                <!-- <h1 class="contents modal_product_name">{{$product_details['product']['title']}}</h1> -->

                <div class="product-prices mt-2 mb-2">
                    <?php
                        //echo $product_details['variants'][0]['price'];
                        $plus_40 = $product_details['variants'][0]['price'] + $product_details['variants'][0]['price']/100*40;
                        //echo $plus_40;
                    ?>
                    <h3>Profit (<span class="total_price_plus_profit_label">{{$plus_40}}</span>)</h3>
                    <input type="hidden" class="total_price_plus_profit" value="{{$plus_40}}" />
                    <input type="number" class=" form-control current-price modal_product_price" value="0" />
                </div>

                <h3>Product Description</h3>
                <textarea class="form-control product_description" cols="" rows="10">
                    {!!$product_details['product']['description']!!}
                </textarea>

                <div class="product-actions">
                <div class="product-variants">
                    <div class="clearfix product-variants-item mt-3">
                        <strong class="control-label"> Selected Sizes</strong>
                        <br>
                        <p>{{implode(", ",$sizes)}}</p>
                    </div>
                </div>

                <div class="product-variants">
                    <div class="clearfix product-variants-item mt-3">
                        <strong class="control-label"> Selected Colors</strong>
                        <br>
                        <p>
                            <?=$color_html?>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                    <p style="color: #131415;font-weight:600;margin-bottom:0">Select Stores</p>
                        <select multiple data-style="bg-white rounded-pill shadow-sm " class="form-control selectpicker w-100 selected_stores">
                            @foreach($stores as $store)
                                <option>{{$store->name}}</option>
                            @endforeach
                        </select><!-- End -->
                    </div>
                </div>

                <div class="product-add-to-cart">
                    <div class="product-quantity clearfix">
                        <div class="qty_product_id">
                        <div class=" bootstrap-touchspin">
                            <button class="btn btn-default add-to-cart add_cart_group ml-3" style="color:#fff;" product_list_id="{{$Product_List->id}}" product_id="{{$product_details['product']['id']}}" onclick="addtostore(this)" >
                                Add to Store
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

        </div>
    </div>

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
                                                        echo "<img class='gallery_image_view img-polaroid tt' src='".url('/').'/Image/'.Auth::user()->id_company."/".$file."' /> <br />";
                                                        echo "</div>";
                                                    }
                                                }
                                                closedir($dh);
                                            }
                                        }
                                    ?>
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

<div id="test"></div>

    <script type="text/javascript">
            let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $(document).on("keyup", ".modal_product_price", function(){
                var profit = $(this).val();
                if(profit=="")
                {
                    profit = 0;
                }
                var total_price_plus_profit = parseFloat($(".total_price_plus_profit").val())+parseFloat(profit);
                $(".total_price_plus_profit_label").text( total_price_plus_profit.toFixed(2) );
            });

            function addtostore(elem)
            {
                var product_id = $(elem).attr("product_id");
                var product_list_id = $(elem).attr("product_list_id");
                var product_name = $(".product_name").val();
                var modal_product_price = $(".modal_product_price").val();
                var product_description = $(".product_description").val();
                var stores = $(".selectpicker").val();

                console.log("product_id", product_id);
                console.log("product_name", product_name);
                console.log("modal_product_price", modal_product_price);
                console.log("product_description", product_description);
                console.log("stores", stores);

                if(product_name == "" || modal_product_price == "" || product_description == "" || stores==null)
                {
                    alertify.error("Please fill the fields properly.");
                    return false;
                }
                $.ajax({
                    type: "POST",
                    data: {
                        id: product_id,
                        product_list_id: product_list_id,
                        product_name: product_name,
                        modal_product_price: modal_product_price,
                        product_description: product_description,
                        stores: stores,
                        _token: _token
                    },
                    url: "{{$domain_name}}/addproductlist_store",
                    async: true,
                    success: function(data) {
                        data = JSON.parse(data);
                        //console.log("data", data);
                        if(data.status=="success")
                        {
                            Swal.fire({
                            title: '<strong class="proof_popup_title">Product Edit</strong>',
                            icon: 'success',
                            html: ' <p style="text-align: center;">Your Product has been add into stores.</p>',
                            confirmButtonText: 'Okay',
                            allowOutsideClick: true,
                            showCloseButton: false,
                            allowOutsideClick: false,
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                     window.location = "{{$domain_name}}/dashboard_stores"
                                    }
                            })
                        }
                    }
                });
            }
    </script>


@endsection

@push('js')
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="https://dashboard.blinkswag.com/public/assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/fabric.js"></script>
    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/tshirtEditor.js"></script>
    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/jquery.miniColors.min.js"></script>
    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/html5.js"></script>
    <script type="text/javascript" src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/loading.js"></script>
    <script type="text/javascript"
            src="{{env('APP_URL')}}/public/assets/js/tshirt_editor/js/FileSaver (2).js"></script>
    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="{{env('APP_URL')}}/public/assets/js/tshirt_editor/css/jquery.miniColors.css"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}/public/assets/js/tshirt_editor/css/loader.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}/public/assets/js/tshirt_editor/css/bootstrap-responsive.min.css" rel="stylesheet">
    <script type="text/javascript">
$(document).ready(function () {

    /*******************************************************************************/
    function getContentImage() {

        var element = $(".shirtDiv:visible");

        html2canvas($(element)[0]).then(canvas => {
            // document.body.appendChild(canvas)
            $(canvas).get(0).toBlob(function (blob) {
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(blob);
            $('#test').append('<img src="' + imageUrl + '"><br>');

        });
    })
        ;
    }

    function LoadeShirts() {
        $('.loading-blink').loading();
        $('.loading-blink').show();
        getContentImage();

        // setTimeout(function () {
        //     rotate();
        // }, 500);
        // setTimeout(function () {
        //     getContentImage();
        // }, 1200);
    }

    /*******************************************************************************/


    $('#loading-custom-overlay').loading({
        overlay: $('#custom-overlay')
    });
    $('.loading-blink').hide();

    $(document).on("click", ".imgsavejpg", function(event){
        var file_name = $(this).attr("attr-type");

        $(".nb-spinner").show();
        var _that = $(this);
        var getCanvas; // global variable

        var org_bg = $(".shirtDiv:visible").css("background-color");
        var counter = 0;
        window.saveImage = function(){
            var value = $(".right_settings:first input.checkbox-round:eq("+counter+")");
            var variant_id = $(value).attr("variant_id");
            console.log("variant_id", variant_id);

            var color_code = $(value).attr("color_code");
            console.log("color_code23", color_code);
            $(".shirtDiv:visible").css("background-color", color_code);
            var element = $(".shirtDiv:visible");
            html2canvas($(element)[0]).then(canvas => {
                var imgageData = canvas.toDataURL("image/png");
                console.log("imgageData", imgageData);
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $(_that).next().find("a").attr("download", "Mockup.png").attr("href", newData);
                //$(".nb-spinner").hide();
                $(_that).next().find("a").show();

                console.log("newData", newData);
                var myimage = imgageData; //$(input).prop("files")[0];
                var fd = new FormData();
                fd.append("myimage", myimage);
                fd.append("file_name", file_name+"_"+variant_id+".png");
                fd.append("product_list_id", "{{$Product_List->id}}");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/uploadimage_mockup",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            //$(".shirtDiv:visible").css("background-color", background_color);

                            if(file_name=="front")
                            {
                                $(".modal_product_image").attr("src", newData);
                            }

                            // Swal.fire({
                            // title: '<strong class="proof_popup_title">Your mockup has been saved successfully!</strong>',
                            // icon: 'success',
                            // html: ' <p style="text-align: center;"></p>',
                            // confirmButtonText: 'Okay',
                            // allowOutsideClick: true,
                            // showCloseButton: false,
                            // allowOutsideClick: false,
                            // }).then((result) => {
                            //         if (result.isConfirmed) {
                            //         //location.reload();
                            //         }
                            //     })
                            counter++;
                            console.log('length', $(".right_settings:first input.checkbox-round:eq("+counter+")").length);
                                if($(".right_settings:first input.checkbox-round:eq("+counter+")").length!=0)
                                {
                                    saveImage();
                                }else{
                                    $(".shirtDiv:visible").css("background-color", org_bg);
                                    $(".nb-spinner").hide();
                                }
                        }
                    }
                });

            });
        };
        saveImage();
        return false;

        var org_bg = $(".shirtDiv:visible").css("background-color");
        $(".right_settings:first input.checkbox-round").each(function(index, value){
            var variant_id = $(value).attr("variant_id");
            console.log("variant_id", variant_id);

            var color_code = $(value).attr("color_code");
            console.log("color_code23", color_code);
            $(".shirtDiv:visible").css("background-color", color_code);
            //return false;



            var element = $(".shirtDiv:visible");
            html2canvas($(element)[0]).then(canvas => {
                var imgageData = canvas.toDataURL("image/png");
                console.log("imgageData", imgageData);
                var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $(_that).next().find("a").attr("download", "Mockup.png").attr("href", newData);
                $(".nb-spinner").hide();
                $(_that).next().find("a").show();

                console.log("newData", newData);
                var myimage = imgageData; //$(input).prop("files")[0];
                var fd = new FormData();
                fd.append("myimage", myimage);
                fd.append("file_name", file_name+"_"+variant_id+".png");
                fd.append("product_list_id", "{{$Product_List->id}}");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{$domain_name}}/uploadimage_mockup",
                    type: "POST",
                    data:fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        if(data.status=="success")
                        {
                            //$(".shirtDiv:visible").css("background-color", background_color);

                            if(file_name=="front")
                            {
                                $(".modal_product_image").attr("src", newData);
                            }

                            Swal.fire({
                            title: '<strong class="proof_popup_title">Your mockup has been saved successfully!</strong>',
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

        });
        //$(".shirtDiv:visible").css("background-color", org_bg);
        //return false;

        // var element = $(".shirtDiv:visible");
        //  html2canvas($(element)[0]).then(canvas => {
        //     var imgageData = canvas.toDataURL("image/png");
        //         console.log("imgageData", imgageData);
        //         var newData = imgageData;//.replace(/^data:image\/png/, "data:application/octet-stream");
        //         $(_that).next().find("a").attr("download", "Mockup.png").attr("href", newData);
        //         $(".nb-spinner").hide();
        //         $(_that).next().find("a").show();

        //         console.log("newData", newData);
        //         var myimage = imgageData; //$(input).prop("files")[0];
        //         var fd = new FormData();
        //         fd.append("myimage", myimage);
        //         fd.append("file_name", file_name+".png");
        //         fd.append("product_list_id", "{{$Product_List->id}}");
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         $.ajax({
        //             url: "{{$domain_name}}/uploadimage_mockup",
        //             type: "POST",
        //             data:fd,
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             success: function(data) {
        //                 data = JSON.parse(data);
        //                 if(data.status=="success")
        //                 {
        //                     if(file_name=="front")
        //                     {
        //                         $(".modal_product_image").attr("src", newData);
        //                     }

        //                     Swal.fire({
        //                     title: '<strong class="proof_popup_title">Your mockup has been saved successfully!</strong>',
        //                     icon: 'success',
        //                     html: ' <p style="text-align: center;"></p>',
        //                     confirmButtonText: 'Okay',
        //                     allowOutsideClick: true,
        //                     showCloseButton: false,
        //                     allowOutsideClick: false,
        //                     }).then((result) => {
        //                             if (result.isConfirmed) {
        //                             //location.reload();
        //                             }
        //                         })

        //                 }
        //             }
        //         });

        //     });
    });

    // $('.imgsavejpg').on('click', function () {
    //     function save() {
    //         html2canvas(document.querySelector("#test")).then(canvas => {
    //                 // document.body.appendChild(canvas)
    //                 $(canvas).get(0).toBlob(function (blob) {
    //                 var filesaver = saveAs(blob, "TShirt.png");
    //                 filesaver.onwriteend = function () {
    //                     $('.loading-blink').hide();
    //                     $('#test').empty();
    //                 }
    //             });
    //         });
    //     }
    //     //mycode
    //     // var element = $(".shirtDiv:visible");
    //     // html2canvas($(element)[0]).then(canvas => {
    //     //     $(canvas).get(0).toBlob(function (blob) {
    //     //         var urlCreator = window.URL || window.webkitURL;
    //     //         var imageUrl = urlCreator.createObjectURL(blob);
    //     //         $('#test').append('<img src="' + imageUrl + '"><br>');
    //     //         save();
    //     //     });
    //     // });
    //     //mycode
    //     // LoadeShirts();
    //     // setTimeout(function () {
    //     //     save();
    //     // }, 2000);
    // });

    $('#rotate').click(function (e) {
        e.preventDefault();
        rotate();
    });

    function rotate() {
        $('#flip').click();
    }


    $('#shirtstyle').on('change', function () {
        $('#tshirtFacing').attr("src", "img/t-shirts/" + $(this).val() + "_front.png");
        IMAGE_NAME = $(this).val();
    });

    $('#imgsavepdf').on('click', function () {
        $('.loading-blink').loading();
        $('.loading-blink').show();
        var doc = new jsPDF();
        doc.setFontSize(20);

        setTimeout(function () {
            html2canvas(document.querySelector(".shirtDiv")).then(canvas => {
                function convertCanvasToImage(c)
            {
                var image = new Image();
                image.src = c.toDataURL("image/jpeg");
                doc.addImage(image.src, 'JPEG', 30, 5, 145, 145);
                return image;
            }
            convertCanvasToImage(canvas);

        })
            ;
        }, 100);
        setTimeout(function () {
            rotate();

        }, 700);
        setTimeout(function () {
            html2canvas(document.querySelector(".shirtDiv")).then(canvas => {
                function convertCanvasToImage(c)
            {
                var image = new Image();
                image.src = c.toDataURL("image/jpeg");
                doc.addImage(image.src, 'JPEG', 30, 150, 145, 145);
                return image;
            }
            convertCanvasToImage(canvas);
        })
            ;
        }, 1100);
        setTimeout(function () {
            doc.save("T-Shirt.pdf");
            $('.loading-blink').hide();
            $('#test').empty();
        }, 1700);

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
                                                                    <img class='gallery_image_view img-polaroid tt' src='`+image_path+`/`+data.filename+`' /> <br />
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

    setTimeout(() => {
        $(".design_mockup_container, .design_layout").hide();
    }, 2000);

       // function openView(evt, cityName) {
    // // Declare all variables
    // var i, tabcontent, tablinks;

    // // Get all elements with class="tabcontent" and hide them
    // tabcontent = document.getElementsByClassName("tabcontent");
    // for (i = 0; i < tabcontent.length; i++) {
    //     tabcontent[i].style.display = "none";
    // }

    // // Get all elements with class="tablinks" and remove the class "active"
    // tablinks = document.getElementsByClassName("tablinks");
    // for (i = 0; i < tablinks.length; i++) {
    //     tablinks[i].className = tablinks[i].className.replace(" active", "");
    // }

    // // Show the current tab, and add an "active" class to the link that opened the tab
    // document.getElementById(cityName).style.display = "block";
    // evt.currentTarget.className += " active";
    // }
    // document.getElementById("defaultOpen").click();

    $(document).on("click",".edit_mockup", function(event){
        //alert("edit t-shirt");
        $(".design_mockup_container").show();
        $(".design_layout_front").show();
        $(".right_settings").show();

        $(".editor_layout").hide();
    });
    $(document).on("click",".mockup_tabs li a", function(){
        var data_layout = $(this).attr("data-layout");
        $(".design_layout").hide();
        $("."+data_layout).show();

        $(".nav-link.active").removeClass("active");
        $(this).addClass("active");
    });
    $(document).on("click",".close_design",function(){
        $(".design_mockup_container").hide();
        $(".design_layout_front").hide();
        $(".right_settings").hide();

        $(".editor_layout").show();
        $(".loader").show();
        $.ajax({
            type: "POST",
            dataType:'html',
            data: {
                product_list: "{{$Product_List->id}}",
                _token: _token
            },
            url: "{{$domain_name}}/getmockupsdesign",
            async: true,
            success: function(data) {
                console.log(data);
                $(".images-container").html(data);
                //$(".addProductDetails").html(data);
                $(".loader").hide();
                //$("#product_details_modal").modal("show");
            }
        })
    });
    $(document).on("click",".gallery_left", function(){
        $(".gallery_left.active").removeClass("active");
        $(this).addClass("active");

        var img_src = $(this).find("img:first").attr("src");
        $("img.modal_product_image").attr("src",img_src);
    });
    // $(document).on("click",".save_mockup_design",function(){
    //     //alert("aa");
    //         function save() {
    //             html2canvas(document.querySelector("#test")).then(canvas => {
    //                     // document.body.appendChild(canvas)
    //                     $(canvas).get(0).toBlob(function (blob) {
    //                     var filesaver = saveAs(blob, "TShirt.png");
    //                     filesaver.onwriteend = function () {
    //                         $('.loading-blink').hide();
    //                         $('#test').empty();
    //                     }
    //                 });
    //             });
    //         }
    //             //mycode
    //             //var element = $(".shirtDiv:visible");
    //             window.newData = [];
    //             $(".shirtDiv").each(function(index, element){
    //                 console.log(123, element);
    //                 $(".design_layout").hide();
    //                 $(element).parents(".design_layout:first").show();

    //                 html2canvas(element).then(canvas => {
    //                         var imgageData = canvas.toDataURL("image/png");
    //                         newData[index] = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    //                         //$(_that).next().find("a").attr("download", "Mockup.png").attr("href", newData);
    //                         //$(".nb-spinner").hide();
    //                         //$(_that).next().find("a").show();

    //                         //$('#test').append('<a download="Mockup'+index+'.png" href="' + newData + '">Download</a><br>');
    //                 });

    //                 html2canvas($(element)[0]).then(canvas => {
    //                     $(canvas).get(0).toBlob(function (blob) {
    //                         var urlCreator = window.URL || window.webkitURL;
    //                         var imageUrl = urlCreator.createObjectURL(blob);
    //                         $('#test').append('<img src="' + imageUrl + '"><br>');
    //                         //save();
    //                     });
    //                 });
    //             })
    //             console.log("newData", newData)
    //             //mycode
    //         // LoadeShirts();
    //         // setTimeout(function () {
    //         //     save();
    //         // }, 2000);
    // });

});


//$(".design_mockup_container, .design_layout").hide();
</script>
            @endpush
