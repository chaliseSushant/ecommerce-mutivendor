<section class="col-lg-12 col-sm-12 cart-body mb-5 mt-5">
    <section class="row justify-content-center">
        <section class="col-lg-8 cart">
            <section class="row">
                <section class="col-12 cart-container-wrap">
                    <section class="row cart-container">
                        <section class="col-12 cart-wrap">
                            <section class="row cart-heading-wrap">
                                <section class="col-5 text-center cart-heading cart-heading-product">
                                    Product
                                </section>
                                <section class="col-2 text-center cart-heading cart-heading-rate">
                                    Rate
                                </section>
                                <section class="col-2 text-center cart-heading cart-heading-quantity">
                                    Quantity
                                </section>
                                <section class="col-2 text-center cart-heading cart-heading-total">
                                    Total
                                </section>
                                <section class="col-1 text-center cart-heading cart-heading-total">
                                </section>

                            </section>
                            {{--Loop For Products--}}
                            @foreach($cart->cartItems as $item)
                                @include('frontend.components.cart-item-single')
                            @endforeach
                            {{--Loop For Products--}}
                        </section>
                    </section>
                </section>
            </section>
        </section>
        <section class="col-lg-4 cart-summary">
            <section class="row">
                <section class="col-12 cart-summary-title-wrap">
                    <h6 class="cart-summary-title">
                        Cart Summary
                    </h6>
                </section>
                <section class="col-12 summary-wrap">
                    <section class="row summary-row">
                        <section class="col-6 summary-label">
                            Subtotal
                        </section>
                        <section class="col-6 summary-value">
                            Rs. {{$cart->subTotal()}}
                        </section>
                    </section>
                    @if($cart->instant_delivery() != 0)
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Instant Delivery
                            </section>
                            <section id="shipping-amount-{{$cart->id}}" class="col-6 summary-value">
                                Rs. {{$cart->instant_delivery()}}
                            </section>
                        </section>
                    @endif
                    <section class="row summary-row">
                        <section class="col-6 summary-label">
                            Shipping Amount
                        </section>
                        <section id="shipping-amount-{{$cart->id}}" class="col-6 summary-value">
                            Rs. {{$cart->shipping()}}
                        </section>
                    </section>
                    <section class="row summary-row">
                        <section class="col-6 summary-label">
                            Discount
                        </section>
                        <section id="discount-amount-{{$cart->id}}" class="col-6 summary-value">
                            - Rs. 0
                        </section>
                    </section>
                    <section class="row summary-row">
                        <section class="col-6 summary-label">
                            Total
                        </section>
                        <section class="col-6 summary-value cart-total">
                            Rs. {{$cart->total()}}
                        </section>
                    </section>
                    <section class="row delivery-options">
                        <section class="col-12">
                            <a class="btn btn-warning full-width-btn"  href="{{url('/cart/checkout/'.$cart->id)}}">Proceed To Checkout</a>
                        </section>
                    </section>
                </section>
            </section>
        </section>
        @if($cart->deliverable_districts != null)
        <section class="col-lg-12 mt-2 mb-3">
            <div class="alert alert-warning" role="alert">
                This cart can only be delivered in {{$cart->deliverable()}} District(s) because cart contains instant delivery item(s) or items of non-national delivery are added to cart.
            </div>
        </section>
        @endif
    </section>
</section>
{{--<script>
    $('.delivery-opt').on('change',function () {
        debugger;
        var value = $(this).val();
        var cart_id = '{{$cart->id}}'
        var url = '{{url('/cart/shipping_charge/')}}'+"/"+value+"/"+cart_id;

        $.ajax({
            type:'json',
            method:"get",
            url:url,
            success:function (response) {
                console.log(response.shipping_charge);
                $('#shipping-amount-{{$cart->id}}').text("Rs. "+response.shipping_charge);
                var total = parseInt(response.shipping_charge) + parseInt('{{$cart->subTotal()}}');
                $('.cart-total').text("Rs. "+total);

            }
        })
    })
</script>--}}
