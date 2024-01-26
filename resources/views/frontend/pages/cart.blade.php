@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Cart</h3>
    </div>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row">
                        @if($carts->count() >=1 )
                            @foreach($carts as $cart)
                                @include('frontend.components.cart-single')
                            @endforeach
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
