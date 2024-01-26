@extends('frontend.layouts.app')
@section('content')
    <div class="row page-body">
        <section class=" col-lg-12 col-sm-12 body-section-wrap">
            <section class="body-section background-white">
                <section class="row">
                    <section class="col-12">
                        <h3 class="page-title">Place Order</h3>
                    </section>
                    <section class="col-12 payment-option-section">
                        <section class="row">
                            <section class="col-lg-4 col-sm-12 section delivery-address">
                                <h6 class="section-title"> Deliver To</h6>
                                @php
                                if ($order->delivery_address != null)
                                {
                                    $address = $order->delivery_address;
                                }
                                elseif ($order->courier_id != null)
                                {
                                    $address = $order->courier->name;
                                }
                                else
                                {
                                    $address = 'N/A';
                                }
                                @endphp
                                <p>{{$address}}</p>
                            </section>
                            <section class="col-lg-8 col-sm-12 section payment-option">
                                <section class="row">
                                    <section class="col-12">
                                        <h6 class="section-title"> Select Payment Option</h6>
                                    </section>
                                    <section class="col-12 payment-btns-wrap">
                                        <section class="row">
                                            @if($order->store->paymentGateway->khalti_enable == true && $order->store->paymentGateway->khalti_public_key != null && $order->store->paymentGateway->khalti_secret_key != null)
                                            <section class="col-3 khalti-pay-btn">
                                                @include('frontend.components.payvia-khalti')
                                            </section>
                                            @endif
                                                @if($order->store->paymentGateway->esewa_enable == true && $order->store->paymentGateway->esewa_public_key != null && $order->store->paymentGateway->esewa_secret_key != null)
                                                <section class="col-3 esewa-pay-btn">
                                                @include('frontend.components.payvia-esewa')
                                                </section>
                                                @endif
                                        </section>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </div>
@endsection
