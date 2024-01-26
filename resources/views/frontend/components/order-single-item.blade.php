<section class="row cart-item-wrap">
    <section class="col-6 cart-item-product">
        <section class="row cart-item-product-row">
            <section class="col-4">
                <img class="img-thumbnail" src="@if($item->product->thumbnail != null){{url($product->thumbnail)}}@endif" onerror="this.onerror=null; this.src='{{url('/frontend/images/product.jpg')}}'">
            </section>
            <section class="col-8">
                <section class="row cart-item-product-title-wrap">
                    <section class="col-12 cart-item-product-title">{{$item->product->name}}</section>
                    <section class="col-12 cart-item-product-brand">{{$item->product->brand->name}}</section>
                </section>
            </section>
        </section>
    </section>
    <section class="col-2 cart-item-rate-wrap">
        <section class="row cart-item-rate">
            <section class="col-12 text-center cart-item-price">Rs. {{$item->product->price}}</section>
        </section>
    </section>
    <section class="col-2 text-center cart-item-quantity">
        x {{$item->quantity}}
    </section>
    <section class="col-2 text-right cart-item-total">
        = Rs. {{$item->product->price * $item->quantity}}
    </section>
</section>
