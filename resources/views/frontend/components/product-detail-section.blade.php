<section class="col-lg-7 col-sm-12 product-detail-section">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-12 product-info mb-3">
                    <div class="row">
                        <section class="col-12 title">
                            <h6>{{$product->name}}</h6>
                        </section>
                        <div class="col-12 rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <section class="col-12 brand light-font">
                            <a href="{{url('/brand/'.$product->brand->id)}}">{{$product->brand->name}}</a>
                        </section>
                        <section class="col-12 price">
                            <span>Rs. {{$product->price}}</span>
                        </section>
                    </div>
                </div>
                <div class="col-12 cart-section">
                    <form method="post" action="{{url('product/add-to-cart/'.$product->id)}}">
                        @csrf
                        @if($product->instant_delivery)
                        <div class="form-check mb-1">
                            <input type="checkbox" id ="instant_checkbox" name="instant" class="form-check-input">
                            <label class="small form-check-label" for="instant_checkbox"> <strong>Instant Delivery </strong><span class="text-muted italic">(Get delivery within hours with Addon Charges.)</span></label>
                            <label class="small form-check-label" for="instant_checkbox"><span class="text-muted italic"><strong>@</strong> Rs. {{$product->shipping_instant_base}} & Rs. {{$product->shipping_instant_additional}} per additional quantity</span></label>
                        </div>
                        @endif
                        <div class="input-group">
                            <input type="number" name="quantity" min="1" class="form-control add-quantity-to-cart" placeholder="Quantity">
                            <div class="input-group-append">
                                <button type="submit" class="btn-add-to-cart btn btn-warning"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add</button>
                            </div>
                            {{--<button  type="submit" class="btn-buy-now btn btn-warning half-width"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</button>--}}
                        </div>
                    </form>
                </div>
                <div class="col-12 product-description">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
        <section class="col-lg-4 col-md-4 col-sm-12 col-xs-12 product-infobar">
            <section class="row">
                <div class="col-12 sub-section shareable">
                    <ul class="sharable-list">
                        <li class="shareable-item"><a href="https://www.facebook.com/sharer/sharer.php?u={{url('/product/'.$product->id)}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li class="shareable-item"><a href="https://twitter.com/intent/tweet?url={{url('/product/'.$product->id)}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li class="shareable-item"><a href="whatsapp://send?text=Buy on {{config('app.name')}} {{url('/product/'.$product->id)}}" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                        <li class="shareable-item"><a href="mailto:?subject={{$product->name}}&amp;body= Buy on {{config('app.name')}} {{url('/product/'.$product->id)}}" target="_blank"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                        <li class="shareable-item"><a title="Click To Copy Link" href="#" onclick="copyToClipboard();"><i class="fa fa-clipboard" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                @if($product->display_price !=0 || $product->display_price == $product->price )
                <div class="col-12 sub-section price-group">
                    <h6 class="title">You Save: </h6>
                    <span class="price">Rs. {{$product->price}}</span>
                    <strike class="display-price">Rs. {{$product->display_price}}</strike>
                    <span class="discount">({{$product->discount()}}%)</span>
                </div>
                @endif
                <div class="col-12 sub-section price-group">
                    <h6 class="title">Shipped From: </h6>
                    <ul class="price">
                        @foreach($product->outlets as $outlet)
                            <li>{{$outlet->district->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </section>
    </div>
</section>
