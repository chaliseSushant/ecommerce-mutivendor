@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper offwhite">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <section class="col-lg-10 col-sm-12 col-10 mt-3 mb-5 page-content-wrap">
                    <section class="mb-4 mt-4 page-title-wrap">
                        <h4 class="page-title">
                            {{$page->title}}
                        </h4>
                    </section>
                    <section class="mb-4 page-body">
                        {!! $page->description !!}
                    </section>
                </section>
            </div>
        </div>
    </div>
@endsection
