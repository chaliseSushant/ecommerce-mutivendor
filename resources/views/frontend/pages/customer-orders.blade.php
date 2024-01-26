@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Orders</h3>
    </div>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">

                        {{------}}
                        <section class="col-12 section order-cart-summary">
                            <section class="row">
                                @foreach($orders as $order)
                                    <section class="col-10">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($order->cart->cartItems as $item)
                                                    @include('frontend.components.order-single-item')
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col-2 order-actions">
                                        <section class="row">
                                            <section class="col-12">
                                                @if($order->payment_complete == 0)
                                                    <a class="btn btn-warning full-width-btn-sm" href="{{url('/order/checkout/payment/'.$order->id)}}">Pay</a>
                                                @endif
                                                <a class="btn btn-secondary full-width-btn-sm" href="{{url('/customer/order/'.$order->id)}}">Detail</a>
                                                {{--@if($order->orderStatus->name == 'Pending' || $order->orderStatus->name == 'Processing Payment' || $order->orderStatus->name == 'Partially Paid')
                                                    <a class="btn btn-warning full-width-btn-sm" href="{{url('/order/cancel/'.$order->id)}}">Cancel</a>
                                                @endif--}}
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                                {{--<div class="col-12 container-progress">
                                    <div class="progress-container">
                                        <div class="progress" id="progress"></div>
                                        <div class="circle">1</div>
                                        <div class="circle">2</div>
                                        <div class="circle">3</div>
                                        <div class="circle">4</div>
                                    </div>
                                    <button class="btn" id="prev" disabled>Previous</button>
                                    <button class="btn" id="next">Next</button>
                                </div>--}}
                            </section>
                        </section>

                        {{------}}

            </div>
        </div>
    </div>
@endsection
