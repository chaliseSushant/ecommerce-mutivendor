<section class="col-3 category-product-grid-6">
    <div class="row box">
         <a href="{{url('product/'.$product->id)}}" class="col-12 product-img-wrapper">
             <img class="product-img" src="@if($product->thumbnail != null){{url($product->thumbnail)}}@endif" onerror="this.onerror=null; this.src='{{url('/frontend/images/product.jpg')}}'">
         </a>
         <div class="col-12 product-info">
                    <div class="row">
                        <div class="col-9 stickers">
                            @if($product->vendor->certified == true)
                                <img class="inherit-width" src="{{url('/frontend/images/certified.png')}}">
                            @endif
                            @if($product->instant_delivery == true)
                                    <img class="inherit-width" src="{{url('/frontend/images/instant.png')}}">
                            @endif
                        </div>
                        <div class="col-12 rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="col-12 title">
                            <a href="{{url('product/'.$product->id)}}">{{$product->name}}</a>
                        </div>
                        <div class="col-12 price-group">
                            <span class="price">Rs. {{$product->price}}</span>
                            <strike class="display-price">Rs. {{$product->display_price}}</strike>
                        </div>
                        <section class="col-12 wishlist-toggle-button">
                            <form action="{{'/customer/wishlist/toggle/'.$product->id}}">
                                <input class="btn btn-warning full-width-btn" type="submit" value="Remove" />
                            </form>
                        </section>
                    </div>
                </div>
    </div>
</section>
