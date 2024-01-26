@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_vendor" data-SaveUpdate = "save" data-target="#modal_add_new_vendor">Add New User</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role->name}}</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_role" data-target="#modal_update_role"
                                                   data-id="{{$user->id}}"
                                                   data-role_id="{{$user->role_id}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a href="#"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_new_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.user_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.user_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <div class="modal fade text-left" id="modal_update_role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.edit_user_role')
    </div>
    <script>

        $(function () {
            $('#modal_update_role').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var role = link.data('role_id');


                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #role').val(role);


            })
        })

    </script>
@endsection

