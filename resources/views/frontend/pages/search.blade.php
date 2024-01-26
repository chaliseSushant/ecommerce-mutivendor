@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <section class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar-left">
                    @include('frontend.components.searchbar')
                </section>
                <section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 body">
                    <div class="row">
                        @include('frontend.components.search-topbar')
                        <div class="col-12">
                            <div class="row">
                                @foreach($search_data as $search_datum)
                                    @if($search_datum->getTable() == 'products')
                                        @include('frontend.components.grid-3',['card'=>$search_datum->card()])
                                    @elseif($search_datum->getTable() == 'brands')
                                        @include('frontend.components.brand-grid-3',['card'=>$search_datum->card()])
                                    @elseif($search_datum->getTable() == 'categories')
                                        @include('frontend.components.category-grid-3',['card'=>$search_datum->card()])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
