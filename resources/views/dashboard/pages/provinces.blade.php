@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_province" data-target="#modal_add_update_province">Add New province</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Delivery Enabled</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($provinces as $province)
                                        <tr>
                                            <td>{{$province->name}}</td>
                                            <td>@if($province->is_enabled ==1) Yes @else No @endif</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_province" data-target="#modal_add_update_province"
                                                   data-id="{{$province->id}}"
                                                   data-type="Update"
                                                   data-name="{{$province->name}}"
                                                   data-enabled = "{{$province->is_enabled}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/address/province/delete/')."/".$province->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_update_province" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.province_add_edit')
    </div>

    <script>

        $(function () {
            $('#modal_add_update_province').on('shown.bs.modal',function (e) {
                debugger;
                var modal = $(this);
                var link =  $(e.relatedTarget);
                if(link.data('type') === 'Update')
                {
                    var id = link.data('id');
                    var name = link.data('name');
                    var enabled = link.data('enabled');

                    $('body').find('.modal-title').text('Update Province');
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name').val(name);
                    enabled && modal.find('.modal-body #switch-delivery').attr('checked',true);
                }
                else{
                     $('body').find('.modal-title').text('Add Province');
                }



            })
        })

    </script>

@endsection

