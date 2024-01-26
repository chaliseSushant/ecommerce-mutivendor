@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover wishlist-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Wishlist</h3>
    </div>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                @foreach($wishlists as $wishlist)
                                    @include('frontend.components.wishlist-grid-6',['product' => $wishlist->product])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
