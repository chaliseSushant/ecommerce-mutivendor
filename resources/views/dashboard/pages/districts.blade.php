@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_district" data-target="#modal_add_update_district">Add New district</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Province</th>
                                        <th>Delivery Enabled</th>
                                        <th>CoD Enabled</th>
                                        <th>Vendor Enabled</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($districts as $district)
                                        <tr>
                                            <td>{{$district->name}}</td>
                                            <td>{{$district->province->name}}</td>
                                            <td>@if($district->is_enabled ==1) Yes @else No @endif</td>
                                            <td>@if($district->cod_enabled ==1) Yes @else No @endif</td>
                                            <td>@if($district->is_enabled_vendor ==1) Yes @else No @endif</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_district" data-target="#modal_add_update_district"
                                                   data-id="{{$district->id}}"
                                                   data-type="Update"
                                                   data-name="{{$district->name}}"
                                                   data-province = "{{$district->province_id}}"
                                                   data-enabled = "{{$district->is_enabled}}"
                                                   data-cod_enabled = "{{$district->cod_enabled}}"
                                                   data-vendor_enabled = "{{$district->is_enabled_vendor}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/address/district/delete/')."/".$district->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_update_district" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.district_add_edit')
    </div>

    <script>

        $(function () {
            $('#modal_add_update_district').on('shown.bs.modal',function (e) {
                debugger;
                var modal = $(this);
                var link =  $(e.relatedTarget);
                if(link.data('type') === 'Update')
                {
                    var id = link.data('id');
                    var name = link.data('name');
                    var province = link.data('province');
                    var enabled = link.data('enabled');
                    var cod_enabled = link.data('cod_enabled');
                    var vendor_enabled = link.data('vendor_enabled');

                    $('body').find('.modal-title').text('Update District');
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name').val(name);
                    modal.find('.modal-body #province').val(province);
                    enabled?modal.find('.modal-body #switch-delivery').attr('checked',true):modal.find('.modal-body #switch-delivery').attr('checked',false);
                    cod_enabled?modal.find('.modal-body #switch-cod_delivery').attr('checked',true):modal.find('.modal-body #switch-cod_delivery').attr('checked',false);
                    vendor_enabled?modal.find('.modal-body #switch-vendor_enabled').attr('checked',true):modal.find('.modal-body #switch-vendor_enabled').attr('checked',false);
                }
                else{
                     $('body').find('.modal-title').text('Add District');
                }



            })
        })

    </script>

@endsection

