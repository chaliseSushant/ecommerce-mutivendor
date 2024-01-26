<section class="col-lg-4 col-md-6 col-sm-6 col-xs-6 col-6 product-grid-3">
 <div class="row">
      <a href="{{url($card['url'])}}" class="col-12 product-img-wrapper">
          <img class="product-img" @if($card['image'] != null) src="{{url($card['image'])}}" @else src="" @endif  onerror="this.onerror=null; this.src='{{url("frontend/images/product.jpg")}}'">
      </a>
      <div class="col-12 product-info">
                 <div class="row">
                     <div class="col-12 stickers">
                         @if($card['certified'] == 1)
                             <img src="{{url('/frontend/images/certified.png')}}">
                         @endif
                         @if($card['instant'] == 1)
                             <img src="{{url('/frontend/images/instant.png')}}">
                         @endif
                     </div>
                     <div class="col-9 rating">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star-o"></i>
                         <i class="fa fa-star-o"></i>
                     </div>
                     @if(auth::check() && auth::user()->hasRole('customer'))
                         <div class="col-2 wishlist-toggler-wrapper">
                             <a href="{{url($card['wishlist'])}}" class="text-center wishlist-toggler @if(auth::user()->inWish($card['id']) == true) active @endif"><i class="fa fa-heart"></i></a>
                         </div>
                         @endif
                     <div class="col-12 title">
                         <a href="{{url($card['url'])}}">{{$card['title']}}</a>
                     </div>
                     <div class="col-12 price-group">
                         <span class="price">Rs. {{$card['price']}}</span>
                         @if($card['discount'] != 0)
                         <strike class="display-price">Rs. {{$card['display_price']}}</strike>
                         <span class="discount">({{$card['discount']}}%)</span>
                         @endif
                     </div>
                 </div>
             </div>
 </div>
</section>
