<section class="col-lg-12 col-sm-12 cart-body">
        <section class="row">
            <section class="col-lg-8 cart order-cart">
                <section class="row">
                    <section class="col-12 cart-container-wrap">
                        <section class="row cart-container">
                            <section class="col-12 cart-wrap">
                                <section class="row cart-heading-wrap">
                                    <h6 class="col-5 text-center cart-heading cart-heading-product">
                                        Product
                                    </h6>
                                    <h6 class="col-2 text-center cart-heading cart-heading-rate">
                                        Rate
                                    </h6>
                                    <h6 class="col-2 text-center cart-heading cart-heading-quantity">
                                        Quantity
                                    </h6>
                                    <h6 class="col-3 text-center cart-heading cart-heading-total">
                                        Total
                                    </h6>

                                </section>
                                {{--Loop For Products--}}
                                @foreach($cart->cartItems as $item)
                                    @include('frontend.components.order-detail-item-single')
                                @endforeach
                                {{--Loop For Products--}}
                            </section>
                        </section>
                    </section>
                </section>
            </section>
            <section class="col-lg-4 cart-summary order-cart">
                <section class="row">
                    <section class="col-12 cart-summary-title-wrap">
                        <h6 class="cart-summary-title">
                            Order Summary
                        </h6>
                    </section>
                    <section class="col-12 summary-wrap">
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Subtotal
                            </section>
                            <section class="col-6 summary-value">
                                Rs. {{$order->total_amount}}
                            </section>
                        </section>
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Shipping Amount
                            </section>
                            <section id="shipping-amount-{{$cart->id}}" class="col-6 summary-value">
                                Rs. {{$order->shipping_charge}}
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
                        <hr class="mb-0 mt-0">
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Total
                            </section>
                            <section class="col-6 summary-value cart-total">
                                Rs. {{$order->payable_amount}}
                            </section>
                        </section>
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Paid
                            </section>
                            <section class="col-6 summary-value cart-total">
                                Rs. @if($order->paid_amount != null){{$order->paid_amount}} @else 0 @endif
                            </section>
                        </section>
                        <hr class="mb-0 mt-0">
                        <section class="row summary-row">
                            <section class="col-6 summary-label">
                                Remaining
                            </section>
                            <section class="col-6 summary-value cart-total">
                                Rs. {{$order->payable_amount - $order->paid_amount}}
                            </section>
                        </section>
                        @if($order->payment_complete == 0 && $order->orderStatus->name != 'Cancelled' && $order->orderStatus->name != 'Declined' && $order->orderStatus->name != 'Delivered')
                        <section class="row">
                            <section class="col-12 order-btn-order-detail">
                                <a class="btn btn-warning full-width-btn-sm" href="{{url('/order/checkout/payment/'.$order->id)}}">Pay</a>
                            </section>
                        </section>
                        @endif
                    </section>
                </section>
            </section>
        </section>
    </section>

