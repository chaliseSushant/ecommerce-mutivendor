@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Account</h3>
    </div>
    <div class="page-wrapper offwhite">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row mt-5">
                                    {{--Link Loops--}}
                                    @include('frontend.components.customer-account-link-card',['url'=>'/customer/orders','thumbnail'=>'frontend/images/orders.png','title'=>'My Orders','description'=>'Complete, Track and View Orders'])
                                    @include('frontend.components.customer-account-link-card',['url'=>'/customer/security','thumbnail'=>'frontend/images/security.png','title'=>'Login & Security','description'=>'Edit Account Information & Password'])
                                    @include('frontend.components.customer-account-link-card',['url'=>'/customer/addresses','thumbnail'=>'frontend/images/addr.png','title'=>'My Addresses','description'=>'Add, Edit & Delete Delivery Addresses'])
                                    {{--Link Loops--}}
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
