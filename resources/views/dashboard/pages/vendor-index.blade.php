@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/dashboard/vendors/add_edit/') }}" class="btn btn-primary"  id="btn_add_new_vendor" data-SaveUpdate = "save" >Add New Vendor</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone 1</th>
                                        <th>Certified</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $vendor)
                                        <tr>
                                            <td>{{$vendor->name}}</td>
                                            <td>{{$vendor->phone}}</td>
                                            <td>
                                                <div class="custom-control custom-switch switch-lg custom-switch-success">
                                                    <input type="checkbox" @if($vendor->certified==1) checked @endif value="{{$vendor->id}}" class="custom-control-input certified"  id="switch-certified-{{$vendor->id}}">
                                                    <label class="custom-control-label" for="switch-certified-{{$vendor->id}}">
                                                        <span class="switch-text-left">Yes</span>
                                                        <span class="switch-text-right">No</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch switch-lg custom-switch-success">
                                                    <input type="checkbox" @if($vendor->status==1) checked @endif value="{{$vendor->id}}" class="custom-control-input status"  id="switch-{{$vendor->id}}">
                                                    <label class="custom-control-label" for="switch-{{$vendor->id}}">
                                                        <span class="switch-text-left">Active</span>
                                                        <span class="switch-text-right">Inactive</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="product-action">
                                                <a href="{{ url('/dashboard/vendors/add_edit/')."/".$vendor->id }}" title="Edit Vendor"><i class="feather icon-edit"></i></a>
                                                <a href="{{url('/dashboard/vendor/products')."/".$vendor->id}}" title="View Products"><i class="feather icon-layers success"></i></a>
                                                <a href="{{url('/dashboard/vendor/outlets')."/".$vendor->id}}" title="View Outlets"><i class="feather icon-server warning"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

        $(function () {


            $('.status').on('change',function () {
                var value = $(this).val();
                if($(this).is(':checked') === false)
                {
                    var url = "{{url('dashboard/vendor/status/')."/"}}"+value+"/"+0;
                }
                else
                    var url = "{{url('dashboard/vendor/status/')."/"}}"+value+"/"+1;
                $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        if(response.type ==="update")
                            toastr.success(response.message);
                        else
                            toastr.error(response.message);
                    }
                });
            });
            $('.certified').on('change',function () {
                var value = $(this).val();
                if($(this).is(':checked') === false)
                {
                    var url = "{{url('dashboard/vendor/certified/')."/"}}"+value+"/"+0;
                }
                else
                    var url = "{{url('dashboard/vendor/certified/')."/"}}"+value+"/"+1;
                $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        if(response.type ==="update")
                            toastr.success(response.message);
                        else
                            toastr.error(response.message);
                    }
                });
            });
        })

    </script>


@endsection
