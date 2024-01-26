@extends('frontend.layouts.app')
@section('content')
    <div style="background-image: url('{{url("/frontend/images/cover-default-bakery.jpg")}}');" class="jumbotron-fluid cover vendor-header">
        <h3>{{$vendor->name}}</h3>
    </div>
    <div class="page-wrapper offwhite">
        <div class="container">
            <div class="row">
                <section class="col-12 body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                @foreach($products as $product)
                                    @include('frontend.components.category-grid-6')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
