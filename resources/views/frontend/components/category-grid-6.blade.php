<section class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6 category-product-grid-6">
            <div class="row box">
                <a href="{{url('product/'.$product->id)}}"  class="product-img-wrapper">
                    <img class="product-img" src="@if($product->thumbnail != null){{url($product->thumbnail)}}@endif" onerror="this.onerror=null; this.src='{{url('/frontend/images/product.jpg')}}'">
                </a>
                <div class="product-info">
                    <div class="row">
                        <div class="col-9 stickers">
                            @if($product->vendor->certified == true)
                                <img class="inherit-width" src="{{url('/frontend/images/certified.png')}}">
                            @endif
                            @if($product->instant_delivery == true)
                                    <img class="inherit-width" src="{{url('/frontend/images/instant.png')}}">
                            @endif
                        </div>
                        <div class="col-10 rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        @if(auth::check() && auth::user()->hasRole('customer'))
                            <div class="col-2 wishlist-toggler-wrapper">
                                <a href="{{url('customer/wishlist/toggle'.$product->id)}}" class="text-center wishlist-toggler @if(auth::user()->inWish($product->id) == true) active @endif"><i class="fa fa-heart"></i></a>
                            </div>
                        @endif
                        <div class="col-12 title">
                            <a href="{{url('product/'.$product->id)}}">{{$product->name}}</a>
                        </div>
                        <div class="col-12 price-group">
                            <strike class="display-price">Rs. {{$product->display_price}}</strike>
                            <span class="price">Rs. {{$product->price}}</span>
                        </div>
                    </div>
                </div>
            </div>

</section>
