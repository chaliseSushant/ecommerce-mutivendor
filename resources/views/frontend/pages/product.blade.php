@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-12 body mt-5 mb-3">
                    <div class="row">
                        @include('frontend.components.product-image-slider')
                        @include('frontend.components.product-detail-section')
                        @include('frontend.components.product-specification-section')
                        @include('frontend.components.product-review-section')
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
