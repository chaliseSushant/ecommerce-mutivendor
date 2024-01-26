@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Account</h3>
    </div>
    <div class="page-wrapper offwhite">
        <div class="container">
            <div class="row justify-content-center">
                <section class="col-8 body">
                    <div class="row mt-5">
                                            {{--One Row--}}
                                    <section class="col-12 account-detail-section-wrapper bottom-border">
                                        <section class="row account-detail-section">
                                            <section class="col-10 account-detail-label-wrap">
                                                <section class="row account-detail-label">
                                                    <section class="col-12 label-key">Name: </section>
                                                    <section class="col-12 label-value">{{Auth::user()->name}}</section>
                                                </section>
                                            </section>
                                            <section class="col-2 account-detail-actions ">
                                                <a href="#" data-toggle="modal" data-target="#update-profile"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </section>
                                        </section>
                                    </section>
                                            {{--One Row--}}
                                            {{--One Row--}}
                                    <section class="col-12 account-detail-section-wrapper bottom-border">
                                        <section class="row account-detail-section">
                                            <section class="col-10 account-detail-label-wrap">
                                                <section class="row account-detail-label">
                                                    <section class="col-12 label-key">Gender: </section>
                                                    <section class="col-12 label-value">@if(Auth::user()->customer->gender == 1) Male @elseif(Auth::user()->customer->gender == 2) Female @elseif(Auth::user()->customer->gender == 3) Other @else N/A @endif</section>
                                                </section>
                                            </section>
                                            <section class="col-2 account-detail-actions">
                                                <a href="#" data-toggle="modal" data-target="#update-profile"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </section>
                                        </section>
                                    </section>
                                            {{--One Row--}}
                                            {{--One Row--}}
                                    <section class="col-12 account-detail-section-wrapper bottom-border">
                                        <section class="row account-detail-section">
                                            <section class="col-10 account-detail-label-wrap">
                                                <section class="row account-detail-label">
                                                    <section class="col-12 label-key">Email: </section>
                                                    <section class="col-12 label-value">{{Auth::user()->email}}</section>
                                                </section>
                                            </section>
                                            <section class="col-2 account-detail-actions">
                                                <a href="#" data-toggle="modal" data-target="#change-email"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </section>
                                        </section>
                                    </section>
                                            {{--One Row--}}
                                            {{--One Row--}}
                                    <section class="col-12 account-detail-section-wrapper bottom-border">
                                        <section class="row account-detail-section">
                                            <section class="col-10 account-detail-label-wrap">
                                                <section class="row account-detail-label">
                                                    <section class="col-12 label-key">Password: </section>
                                                    <section class="col-12 label-value">*********</section>
                                                </section>
                                            </section>
                                            <section class="col-2 account-detail-actions">
                                                <a href="#" data-toggle="modal" data-target="#change-password"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </section>
                                        </section>
                                    </section>
                                            {{--One Row--}}
                                            {{--One Row--}}
                                    <section class="col-12 account-detail-section-wrapper">
                                        <section class="row account-detail-section">
                                            <section class="col-10 account-detail-label-wrap">
                                                <section class="row account-detail-label">
                                                    <section class="col-12 label-key">Phone: </section>
                                                    <section class="col-12 label-value">@if(Auth::user()->customer->phone == null) N/A @else {{Auth::user()->customer->phone}} @endif </section>
                                                </section>
                                            </section>
                                            <section class="col-2 account-detail-actions">
                                                <a href="#" data-toggle="modal" data-target="#update-profile"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </section>
                                        </section>
                                    </section>
                                            {{--One Row--}}
                    </div>
                </section>
            </div>
        </div>

    </div>

    @include('frontend.components.customer-profile-update-modal')
    @include('frontend.components.customer-email-change-modal')
    @include('frontend.components.customer-password-change-modal')
@endsection
