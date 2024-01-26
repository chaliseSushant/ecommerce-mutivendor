@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>First Purchase Discount</h5>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input class="discount_type_check" @if($discount_settings->fp_enabled == 1) checked @endif name="fp_enabled" type="checkbox" >
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                            </span>

                            </div>
                        </div>
                        <hr>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <form class="form form-vertical" method="post" action="/dashboard/discount-settings/save_update">
                                    <input type="hidden" value="fp" name="discount_type">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <label>Discount Amount</label>
                                                                <input type="text" id="fp_discount_amt" value="{{$discount_settings->fp_discount}}" class="form-control" name="fp_discount" placeholder="Discount Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <label>Minimum Amount</label>
                                                                <input type="text" id="fp_min_amt" value="{{$discount_settings->fp_min}}" class="form-control" name="fp_min" placeholder="Min Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <label>Duration</label>
                                                                <input type="text" id="fp_discount_duration" value="{{$discount_settings->duration}}" class="form-control" name="duration" placeholder="Discount Duration">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Referral Discount</h5>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input class="discount_type_check" @if($discount_settings->rfr_enabled) checked @endif name="rfr_enabled" type="checkbox" >
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                            </span>

                            </div>
                        </div>
                        <hr>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <form class="form form-vertical" method="post" action="/dashboard/discount-settings/save_update">
                                    @csrf
                                    <input type="hidden" value="rfr" name="discount_type">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Discount Amount</label>
                                                            <input type="text" id="rfr_discount_amt" value="{{$discount_settings->rfr_discount}}" class="form-control" name="rfr_discount" placeholder="Discount Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Minimum Amount</label>
                                                            <input type="text" id="rfr_discount" value="{{$discount_settings->rfr_min}}" class="form-control" name="rfr_min" placeholder="Min Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Duration</label>
                                                            <input type="text" id="rfr_duration" value="{{$discount_settings->rfr_duration}}"  class="form-control" name="rfr_duration" placeholder="Discount Duration">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Refered Discount</h5>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input class="discount_type_check" @if($discount_settings->rfd_enabled) checked @endif name="rfd_enabled" type="checkbox" >
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                            </span>

                            </div>
                        </div>
                        <hr>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <form class="form form-vertical" method="post" action="/dashboard/discount-settings/save_update">
                                    @csrf
                                    <input type="hidden" value="rfd" name="discount_type">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Discount Amount</label>
                                                            <input type="text" id="fp_discount_amt" value="{{$discount_settings->rfd_discount}}" class="form-control" name="rfd_discount" placeholder="Discount Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Minimum Amount</label>
                                                            <input type="text" id="rfd_min" value="{{$discount_settings->rfd_min}}" class="form-control" name="rfd_min" placeholder="Min Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Duration</label>
                                                            <input type="text" id="rfd_duration" value="{{$discount_settings->rfd_duration}}"  class="form-control" name="rfd_duration" placeholder="Discount Duration">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
    <script>
        $(function () {
            $('.discount_type_check').on('change',function () {
                var type = $(this).attr('name');
                $.ajax({
                    type:'get',
                    url:'{{url('/dashboard/discount-settings/enable')."/"}}'+type,
                    success:function () {
                        console.log('Success');
                    }
                })
            })
        })
    </script>
@endsection
