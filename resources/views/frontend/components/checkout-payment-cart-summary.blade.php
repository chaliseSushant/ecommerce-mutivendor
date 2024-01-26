<section class="col-lg-12 col-sm-12 section order-cart-summary">
    <section class="row">
        <section class="col-12">
            <h6 class="section-title">Order Summary</h6>
        </section>
        <section class="col-12">
            @foreach($order->cart->cartItems as $item)
                @include('frontend.components.checkout-payment-cart-summary-single')
            @endforeach
                @include('frontend.components.checkout-payment-cart-summary-total')
        </section>
    </section>
</section>
