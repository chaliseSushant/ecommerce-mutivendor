@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Order No. {{$order->id}}</h3>
    </div>
    <div class="page-wrapper">
        <div class="container">
            <div class="row justify-content-center mt-5">
                    <section class="col-lg-10 col-sm-12">
                        <section class="row">
                            <section class="col-12 order-section-wrap">
                                <section class="row order-section">
                                    <section class="col-6">
                                        <section class="row">
                                            <section class="col-12 order-detail">
                                                <strong>Order Code :</strong> <span>{{$order->id}}</span>
                                            </section>
                                            <section class="col-12 order-detail">
                                                <strong>Last Updated On :</strong> <span>{{$order->updated_at}}</span>
                                            </section>
                                            <section class="col-12 order-detail">
                                                <strong>Payment Method :</strong> <span class="text-uppercase">@if($order->payment_method != null){{$order->payment_method}} @else N/A @endif </span>
                                            </section>
                                        </section>
                                    </section>
                                    <section class="col-6">
                                        <section class="row">
                                            <section class="col-12 order-detail">
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
                                                <strong>Deliver To :</strong> <span>{{$address}}</span>
                                            </section>

                                            <section class="col-12 order-detail">
                                                <strong>Delivery Note :</strong> @if($order->delivery_note != null){{$order->delivery_note}} @else N/A @endif
                                            </section>
                                        </section>
                                    </section>

                                    <section class="col-12 order-detail text-center mt-5 mb-3">
                                        <h5>Items & Payment Details:</h5>
                                    </section>
                                        @include('frontend.components.order-details-items',['cart' => $order->cart])
                                </section>
                            </section>
                        </section>
                    </section>
            </div>
        </div>
    </div>
@endsection

