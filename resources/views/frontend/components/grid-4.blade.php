<section class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6 product-grid-6">
    <div class="row">
         <a href="{{url($card['url'])}}" class="col-12 product-img-wrapper">
                    <img class="product-img" @if($card['image'] != null) src="{{url($card['image'])}}" @else src="" @endif  onerror="this.onerror=null; this.src='{{url("frontend/images/product.jpg")}}'">
                </a>
         <div class="col-12 product-info">
                    <div class="row">
                        <div class="col-12 title">
                            <a href="{{url($card['url'])}}">{{$card['title']}}</a>
                        </div>
                        <div class="col-12 price-group">
                            <span class="price">Rs. {{$card['price']}}</span>
                            @if(auth::check() && auth::user()->hasRole('customer'))
                                <a href="{{url($card['wishlist'])}}" class="text-center wishlist-toggler @if(auth::user()->inWish($card['id']) == true) active @endif"><i class="fa fa-heart"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
    </div>
</section>
