<?php
$all_selected_variatns = json_decode($general_my_editing_single['selected_variants'][0], true);
//dd( $all_selected_variatns[0]['id'] );

$variant_first = $all_selected_variatns[0]['id'];
?>
<!-- <input type="hidden" name="product_details" id="product_details" val="{ { json_encode($product_details)}}" > -->

<div class="modal fade my-items" id="product_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog items" style="max-width: 64rem;" role="document">
    <div  id="model_container" class="modal-content ">

      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
	  <div class="row">
        <div class="col-md-6 col-sm-6 hidden-xs-down single_image">
            <div class="images-container">
                <?php
                    $flag = 0;
                    $dir = public_path('Image/'.$id_company.'/mockups/'.$product_list_id);
                    //echo $dir;
                    if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            while (($file = readdir($dh)) !== false) {
                                if($file!="." && $file!=".." && str_contains($file, $variant_first))
                                {
                                    if($file=="front_".$variant_first.".png")
                                    {
                                        $class="active frontimage";
                                    }else{
                                        $class = "";
                                    }
                                    //echo $file."<br>";
                                    echo "<div class='col-md-3 gallery_image_view_con gallery_left ".$class."' style='position:relative;width:100px; height:100px;'>";
                                    echo "<img style='width: 100%;height: 100%;' class='gallery_image_view img-polaroid tt' src='".url('/').'/Image/'.$id_company.'/mockups/'.$product_list_id.'/'.$file."' /> <br />";
                                    echo "</div>";

                                    if($file=="front_".$variant_first.".png")
                                    {
                                        $flag=1;
                                        ?>
                                        <img style="position: absolute;right: 0px;top: 0px;width: 75%;" class="js-qv-product-cover card-img-top modal_product_image" src="{{url('/')}}/Image/{{$id_company}}/mockups/{{$product_list_id}}/{{$file}}" alt="Card image cap">
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
			    <!-- <img class="js-qv-product-cover card-img-top modal_product_image" src="{{$product_details['product']['image']}}" alt="Card image cap"> -->
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <h1 class="contents modal_product_name">{{$selected_editing['product_name']}}</h1>

		  <div class="product-prices mt-2 mb-2">
                    <?php
                        $plus_40_profit = $product_details['variants'][0]['price'] + $product_details['variants'][0]['price']/100*40 + $selected_editing['profit_price'];
                    ?>
				<div >Price $<span class="current-price modal_product_price">{{$plus_40_profit}}</span>
				</div>
			</div>
				<div class="description modal_product_description">
					{!!nl2br($selected_editing['product_description'])!!}
				</div>

            <div class="product-actions">
                <div class="product-variants">
					<div class="clearfix product-variants-item mt-3">
						<strong class="control-label"> Available Sizes</strong><br>
                        <div class="row">
						    <?php
                                $sizes = [];
                                $clickClass = "";
                                if($flag==1)
                                {
                                    $clickClass = "change_mockup_2";
                                }
                                foreach($all_selected_variatns as $key=>$value)
                                {
                                    if( !in_array($value['size'], $sizes) )
                                    {
                                        ?>

                                            <div class="col-md-2" style="display: flex;justify-content: space-between;">
                                                <label style="width: 100%;display: flex;justify-content: center;align-items: center;">
                                                    {{$value['size']}}
                                                    <input type="radio" name="selected_size" class="form-control checkbox_size checkbox_{{$value['size']}} {{$clickClass}}" value="{{$value['size']}}" style="width: 20px;" />
                                                </label>
                                            </div>
                                        <?php
                                        array_push($sizes, $value['size']);
                                    }
                                }
                            ?>
                        </div>

                        <strong class="control-label"> Available Colors</strong>

                        <div class="row">
                            <div class="col-md-12  product-variants-item mt-3 allColors_view w-100 allColors">
                                <div class="size_value attr_size" id="attribute_color">
                                    <?php
                                        $colors = [];
                                        $clickClass = "";
                                        if($flag==1)
                                        {
                                            $clickClass = "change_mockup";
                                        }
                                        foreach($all_selected_variatns as $key1=>$value1)
                                        {
                                            if( !in_array($value1['color'], $colors) )
                                            {
                                                ?>
                                                    <input type="radio" name="selected_color" product_id="{{$product_list_id}}" value="{{$value1['color_code']}}" class="checkbox_color checkbox-round {{$clickClass}}" style="background-color:{{$value1['color_code']}};" color_code="{{$value1['color_code']}}" variant_id="{{$value1['id']}}" />
                                                <?php
                                                array_push($colors, $value1['color']);
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
				    </div>
				</div>

                <div class="product-add-to-cart">
                    <div class="product-quantity clearfix">
                        <div class="qty_product_id">
                        <div class=" bootstrap-touchspin">
                            <button class="btn btn-default add-to-cart add_cart_group mt-3" style="color:#fff;" product_id="{{$product_details['product']['id']}}" onclick="addtoproductlist(this)" >
                                Add to Cart
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

        </div>
      </div>
      </div>

    </div>
  </div>
</div>
