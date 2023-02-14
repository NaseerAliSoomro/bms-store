<?php
//dd( $product_details['variants'][0]['image'] );
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
			    <img class="js-qv-product-cover card-img-top modal_product_image" src="{{$product_details['product']['image']}}" alt="Card image cap">
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <h1 class="contents modal_product_name">{{$product_details['product']['title']}}</h1>

		  <div class="product-prices mt-2 mb-2">
				<div >Price starting from $<span class="current-price modal_product_price">{{$product_details['variants'][0]['price']}}</span>
				</div>
			</div>
				<div class=          "description modal_product_description">
					{!!nl2br($product_details['product']['description'])!!}
				</div>

            <div class="produc          t-actions">
                <div class="product-variants">
					<div class="clearfix product-variants-item mt-3">
						<strong class="control-label"> Size Available</strong><br>
                        <!-- <div class="row">
						    <?php
                                // $sizes = [];
                                // foreach($product_details['variants'] as $key=>$value)
                                // {
                                //     if( !in_array($value['size'], $sizes) )
                                //     {
                                        ?>

                                                                                    <div class="col-md-12">
                                                <label style="float: left;margin-top: 12px;"> {{$value['size']}} </label>
                                                <input type="checkbox" class="form-control checkbox_size checkbox_{{$value['size']}}" value="{{$value['size']}}" style="width: 20px;" />
                                            </div>
                                            <div class="clearfix product-variants-item mt-3 allColors_view w-100 allColors_{{$value['size']}}" style="display:none">
                                                <!-- <strong class="control-label"> All Colors</strong> --
                                                <div class="size_value attr_size" id="attribute_color">
                                                    <?php
                                                        // $colors = [];
                                                        // foreach($product_details['variants'] as $key1=>$value1)
                                                        // {
                                                        //     if( $value1['size']==$value['size'] )
                                                        //     {
                                                        //         ?>
                                                        //             <input type="checkbox" class="checkbox-round" style="background-color:{{$value1['color_code']}};" color_code="{{$value1['color_code']}}" variant_id="{{$value1['id']}}" />
                                                        //         <?php
                                                        //         array_push($colors, $value1['color']);
                                                        //     }
                                                        // }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                //         array_push($sizes, $value['size']);
                                //     }
                                // }
                            ?>
                        </div> -->
                        <div class="row">
                            <div class="clearfix product-variants-item mt-3 allColors_view w-100 allColors">
                                <strong class="control-label"> All Colors</strong>
                                <div class="size_value attr_size" id="attribute_color">
                                    <?php
                                        $colors = [];
                                        foreach($product_details['variants'] as $key1=>$value1)
                                        {
                                            if( !in_array($value1['color'], $colors) )
                                            {
                                                ?>
                                                    <input type="checkbox" class="checkbox-round" style="background-color:{{$value1['color_code']}};" color_code="{{$value1['color_code']}}" variant_id="{{$value1['id']}}" />
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
                    <div class="product-quan			tity clearfix">
                        <div class="qty_product_id">
                        <div class=" bootstrap-touchspin">
                            <button class="btn btn-default add-to-cart add_cart_group ml-3" style="color:#fff;" product_id="{{$product_details['product']['id']}}" onclick="addtoproductlist(this)" >
                                Add to Product List
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
