@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_privilege" data-target="#modal_add_new_privilege">Add New Privilege</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Privileges</th>
                                        @foreach($roles as $role)
                                            <th>{{$role->name}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($privileges as $privilege)
                                            <tr>
                                                <td>{{$privilege->name}}  <i rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="{{$privilege->description}}" style="cursor: pointer" class="fa fa-question-circle"></i></td>
                                                @foreach($roles as $role)
                                                    <td class="text-center">
                                                        <li class="d-inline-block mr-2">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input class="privilege_check" value="{{$privilege->id}}_{{$role->id}}" type="checkbox" value="false" @if($role->hasPrivilege($privilege->privilege) == true) checked @endif>
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </td>
                                                @endforeach
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
    <div class="modal fade text-left" id="modal_add_new_privilege" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.privilege_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    {{--<div class="modal fade text-left" id="modal_update_privilege" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.privilege_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>--}}
    <script>
        $(function () {
            $('.privilege_check').on('change',function () {
                var value = $(this).val();
                if($(this).is(':checked') === false)
                {
                    var url = "{{url('dashboard/privilege/remove/')."/"}}"+value;
                }
                else
                    var url = "{{url('dashboard/privilege/add/')."/"}}"+value;
                $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        alert(response)
                    }
                });
            });
        });
    </script>
@endsection
