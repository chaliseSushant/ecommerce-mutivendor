<form method="post" id="update_cart_{{$item->id}}" action="{{url('/cart/update/'.$item->id)}}">
    @csrf
    <section class="row cart-item-wrap uneditable">
        <section class="col-5 cart-item-product">
            <section class="row cart-item-product-row">
                <section class="col-4">
                    <img class="img-thumbnail" src="{{Storage::url($item->product->thumbnail)}}" onerror="this.onerror=null; this.src='{{url('/frontend/images/product.jpg')}}'">
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
                <section class="col-12 text-center cart-item-display-price">Rs. {{$item->product->display_price}}</section>
            </section>
        </section>
        <section class="col-2 text-center cart-item-quantity not-editable">
            {{$item->quantity}}
        </section>
        <section class="col-3 text-center cart-item-total">
            Rs. {{$item->total()}}
        </section>

</section>
    <section class="row">
        <div class="progress-container">
            <div class="progress" style="@if(isset($item->orderStatus->delivered)) width:99.99%; @elseif(isset($item->orderStatus->dispatched)) width:66.66%; @elseif(isset($item->orderStatus->ready)) width:33.33%; @elseif(isset($item->orderStatus->accepted)) width:0; @endif"  id="progress"></div>
            <div class="circle @if(isset($item->orderStatus->accepted)) active @endif" data-toggle="tooltip" data-placement="top" title="Accepted"><i class="fa fa-check" aria-hidden="true"></i></div>
            <div class="circle @if(isset($item->orderStatus->ready)) active @endif" data-toggle="tooltip" data-placement="top" title="Ready"><i class="fa fa-gift" aria-hidden="true"></i></div>
            <div class="circle @if(isset($item->orderStatus->dispatched)) active @endif" data-toggle="tooltip" data-placement="top" title="Dispatched"><i class="fa fa-truck" aria-hidden="true"></i></div>
            <div class="circle @if(isset($item->orderStatus->delivered)) active @endif" data-toggle="tooltip" data-placement="top" title="Delivered"><i class="fa fa-home" aria-hidden="true"></i></div>
        </div>
    </section>
</form>
