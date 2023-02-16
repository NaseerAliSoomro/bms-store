<?php
//exit();
//dd( json_decode($Product_List->selected_sizes) );
$selected_size = implode(", ", json_decode($Product_List->selected_sizes));
//dd( $selected_size );
$product_details = json_decode($Product_List->product, true);
$selected_variants_id = json_decode($Product_List->selected_variants_id, true);
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
            <h3>Product Name</h3>
            <input type="text" class="form-control product_name" value="{{$product_details['product']['title']}}">
          <!-- <h1 class="contents modal_product_name">{{$product_details['product']['title']}}</h1> -->

		  <div class="product-prices mt-2 mb-2">
				<div >Price starting from $<span class="current-price modal_product_price">{{$product_details['variants'][0]['price']}}</span>
				</div>
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
                        <p>{{$selected_size}}</p>
                    </div>
				</div>

                <div class="product-variants">
					<div class="clearfix product-variants-item mt-3">
						<strong class="control-label"> Selected Colors</strong>
                        <br>
                        <p>
                            @foreach( $selected_variants_id as $key=>$variant)
                                <input type="checkbox" class="checkbox-round" style="background-color:{{$variant['color']}};" />
                            @endforeach
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
                            <button class="btn btn-default add-to-cart add_cart_group ml-3" style="color:#fff;" product_id="{{$product_details['product']['id']}}" onclick="addtostore(this)" >
                                Add to Store
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
