@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.home-hero-slider')
    <div class="page-wrapper offwhite">
        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    @foreach($containers as $container)
                        @include('frontend.components.'.$container->data()['template'],['data'=>$container->data()])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
