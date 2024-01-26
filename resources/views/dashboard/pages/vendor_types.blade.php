@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_vendor-type" data-target="#modal_add_new_vendor-type">Add New Vendor Type</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendorTypes as $vendorType)
                                        <tr>
                                            <td>{{$vendorType->title}}</td>
                                            <td>{{$vendorType->icon}}</td>

                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_vendor-type" data-target="#modal_update_vendor-type"
                                                   data-id="{{$vendorType->id}}"
                                                   data-title="{{$vendorType->title}}"
                                                   data-icon = "{{$vendorType->icon}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/vendor-type/delete/')."/".$vendorType->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_new_vendor-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.vendor-type_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_vendor-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.vendor-type_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_vendor-type').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var title = link.data('title');
                var icon = link.data('icon');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #title').val(title);
                modal.find('.modal-body #icon').val(icon);
            })
        })

    </script>

@endsection

