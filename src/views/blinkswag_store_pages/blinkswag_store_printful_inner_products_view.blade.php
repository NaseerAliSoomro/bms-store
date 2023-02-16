<div class="tab-content">
    <div class="tab-pane active" id="tab-" role="tabpanel">
        <div class="row main-tab dev">
            @foreach($products as $product)
                <div class="col-md-4 product_cat_id product_cat_id{{$product['main_category_id']}}" product_id="{{$product['id']}}">
                    <div class="content-box">
                        <div class="product-image "  data-toggle="modal" data-target="#products{{$product['id']}}">
                            <img class="img-fluid" src="{{ $product['image']}}">
                        </div>
                        <div class="product-title">
                            <p><strong>{{$product['title']}}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
