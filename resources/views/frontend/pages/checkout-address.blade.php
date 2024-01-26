@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row">

                    <section class="col-lg-6 col-sm-12 address-selector-wrapper">
                        <form method="post" id="checkout-address-form" action="{{url('/cart/checkout/payment/'.$cart->id)}}">
                            @csrf
                            <section class="row">
                                <section class="col-12 section-title">
                                    Please select your address
                                </section>
                                <section class="col-12 address-list-wrap">
                                    <section class="row">
                                        @php
                                            if ($cart->deliveriverable_districts != null)
                                            {
                                                $addresses = Auth::user()->customer->addresses->whereIn('district_id',explode(',',$cart->deliverable_districts));
                                            }
                                            else
                                            {
                                                $addresses = Auth::user()->customer->addresses;
                                            }
                                            @endphp
                                        @if($addresses->count() == 0)
                                            <div class="col-12">
                                                <div class="alert alert-warning" role="alert">
                                                    Your existing addresses do not match with the deliverable address(es) of the cart. Please select addresses with district(s) {{$cart->deliverable()}}.
                                                </div>
                                            </div>
                                        @else
                                            {{--Address(es) Loop--}}
                                            @foreach($addresses as $address)
                                                @include('frontend.components.checkout-address-single')
                                            @endforeach
                                            {{--Address(es) Loop--}}
                                        @endif

                                        <section class="col-12 section-title delivery-note-title">
                                            Delivery Note
                                        </section>
                                        <section class="col-12">
                                            <textarea class="form-control" name="delivery_note" id="delivery-note" cols="4" placeholder="If you have delivery related timing or other request, please let us know."></textarea>
                                        </section>
                                    </section>
                                </section>

                            </section>
                        </form>
                    </section>
                    <section class="col-lg-6 col-sm-12">
                        <section class="row">
                            @include('frontend.components.checkout-address-add')
                        </section>
                    </section>

                    <section class="col-6 checkout-btn-wrap text-right">
                        <a class="btn btn-secondary normal-width" href="{{url('cart')}}">Back</a>
                    </section>
                    <section class="col-6 checkout-btn-wrap text-left">
                        <a class="btn btn-warning normal-width" href="javascript:{}" onclick="document.getElementById('checkout-address-form').submit();">Proceed To Payment</a>
                    </section>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
