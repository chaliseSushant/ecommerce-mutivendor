@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row">
                        <section class="col-12 payment-option-section">
                        <section class="row">
                            <section class="col-8">
                                @include('frontend.components.checkout-payment-cart-summary')
                            </section>
                            <section class="col-4">
                                <section class="col-lg-12 col-sm-12 section delivery-address">
                                    <h6 class="section-title"> Deliver To</h6>
                                    @php
                                        if ($order->address)
                                        {
                                            $address = $order->address->name.', '. $order->address->phone.', '.$order->address->address_01.', '.$order->address->address_02.', '.$order->address->district->name.', '. $order->address->district->province->name;
                                        }
                                        else
                                        {
                                            $address = 'N/A';
                                        }
                                    @endphp
                                    <p class="small">{{$address}}</p>
                                </section>
                                <section class="col-lg-12 col-sm-12 section payment-option">
                                    <section class="row">
                                        <section class="col-12">
                                            <h6 class="section-title"> Select Payment Option</h6>
                                        </section>
                                        <section class="col-12 payment-btns-wrap">
                                            <section class="row">
                                                @if($paymentGateway->khalti_enable == true && $paymentGateway->khalti_public_key != null && $paymentGateway->khalti_secret_key != null)
                                                    <section class="col-12 btn-payment khalti-pay-btn">
                                                        @include('frontend.components.payvia-khalti')
                                                    </section>
                                                @endif
                                                @if($paymentGateway->esewa_enable == true && $paymentGateway->esewa_public_key != null && $paymentGateway->esewa_secret_key != null)
                                                    <section class="col-12 btn-payment esewa-pay-btn">
                                                        @include('frontend.components.payvia-esewa')
                                                    </section>
                                                @endif
                                                @if($paymentGateway->fonepay_enable == true && $paymentGateway->fonepay_qr != null)
                                                        <section class="col-12 btn-payment fonepay-pay-btn">
                                                            @include('frontend.components.payvia-fonepay')
                                                        </section>
                                                @endif
                                                    @if($order->address->district->cod_enabled)
                                                        <section class="col-12 btn-payment cod-pay-btn">
                                                            @include('frontend.components.payvia-cod')
                                                        </section>
                                                    @else
                                                        <section class="col-12">
                                                            <div class="alert alert-warning small">
                                                                Cash On Delivery is Not Available in this location. Please Pay via Other Medium.
                                                            </div>
                                                        </section>
                                                    @endif

                                            </section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </section>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
