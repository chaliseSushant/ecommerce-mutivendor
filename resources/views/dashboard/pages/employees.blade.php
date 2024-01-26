@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_employee" data-target="#modal_add_new_employee">Add New Employee</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_employee" data-target="#modal_update_employee"
                                                   data-id="{{$employee->id}}"
                                                   data-name="{{$employee->name}}"
                                                   data-email="{{$employee->email}}"
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
    <div class="modal fade text-left" id="modal_add_new_employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.employee_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.employee_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_employee').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var name = link.data('name');
                var email = link.data('email');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #email').val(email);


            });


        })

    </script>

@endsection
