<form method="post" id="update_cart_{{$item->id}}" action="{{url('/cart/update/'.$item->id)}}">
    @csrf
    <section class="row cart-item-wrap">
        <section class="col-5 cart-item-product">
            <section class="row cart-item-product-row">
                <section class="col-4">
                    <img class="img-thumbnail" src="@if($item->product->thumbnail != null){{url($item->product->thumbnail)}}@endif" onerror="this.onerror=null; this.src='{{url('/frontend/images/product.jpg')}}'">
                </section>
                <section class="col-8">
                    <section class="row cart-item-product-title-wrap">
                        <section class="col-12 cart-item-product-title">{{$item->product->name}} @if($item->is_instant)<span class="instant-highlight small italic">instant</span>@endif</section>
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
        <section class="col-2 form-group cart-item-quantity">
            <input class="form-control cart-item-quantity-input" name="quantity" type="number" value="{{$item->quantity}}">
        </section>
        <section class="col-2 text-center cart-item-total">
            Rs. {{$item->total()}} {{--<span class="small">+ {{$item->shipping(auth::user()->customer->addresses->where('default',1)->first()->district_id)}}</span>--}}
        </section>
        <section class="col-1 text-center cart-item-action">
            <a href="javascript:{}" onclick="document.getElementById('update_cart_{{$item->id}}').submit();" title="Update Quantity"><i class="fa fa-check"></i></a>
            <a href="{{url('/cart/delete/'.$item->id)}}" title="Delete Item"><i class="fa fa-trash"></i></a>
        </section>
</section>
</form>
