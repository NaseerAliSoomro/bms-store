<div class="images-container">
<?php
    $flag = 0;
    $dir = public_path('Image/'.$id_company.'/mockups/'.$product_id);
    //echo $dir;
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($file!="." && $file!=".." && str_contains($file, $variant_id))
                {
                    if($file=="front_".$variant_id.".png")
                    {
                        $class="active frontimage";
                    }else{
                        $class = "";
                    }
                    //echo $file."<br>";
                    echo "<div class='col-md-3 gallery_image_view_con gallery_left ".$class."' style='position:relative;width:100px; height:100px;'>";
                    echo "<img style='width: 100%;height: 100%;' class='gallery_image_view img-polaroid tt' src='".url('/').'/Image/'.$id_company.'/mockups/'.$product_id.'/'.$file."' /> <br />";
                    echo "</div>";

                    if($file=="front_".$variant_id.".png")
                    {
                        $flag=1;
                        ?>
                        <img style="position: absolute;right: 0px;top: 0px;width: 75%;" class="js-qv-product-cover card-img-top modal_product_image" src="{{url('/')}}/Image/{{$id_company}}/mockups/{{$product_id}}/{{$file}}" alt="Card image cap">
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
    <img class="js-qv-product-cover card-img-top modal_product_image" src="{{$product_details['product']['image']}}" alt="Card image cap">
    <?php
    }
    ?>
</div>
