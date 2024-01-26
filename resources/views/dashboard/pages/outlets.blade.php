@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-type="Add" id="btn_add_new_outlet" data-SaveUpdate = "save" data-target="#modal_add_edit_outlet">Add New Outlet</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($outlets as $outlet)
                                        <tr>
                                            <td>{{$outlet->name}}</td>
                                            <td>{{$outlet->address_01}}</td>
                                            <td>{{$outlet->district->name}}</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_role" data-target="#modal_add_edit_outlet"
                                                   data-id="{{$outlet->id}}"
                                                   data-type="Update"
                                                   data-name="{{$outlet->name}}"
                                                   data-address1="{{$outlet->address_01}}"
                                                   data-address2="{{$outlet->address_02}}"
                                                   data-district="{{$outlet->district_id}}"
                                                   data-province="{{$outlet->district->province->id}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/vendor/outlet/delete')."/".$outlet->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_edit_outlet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.outlet_add_edit')
    </div>


    <script>
        $('#modal_add_edit_outlet').on('shown.bs.modal',function (e) {

                var modal = $(this);

                var link =  $(e.relatedTarget);
                var type = link.data('type');
                if(type==="Update")
                {
                    var id = link.data('id');
                    var name = link.data('name');
                    var address1 = link.data('address1');
                    var address2 = link.data('address2');
                    var province = link.data('province');
                    var district = link.data('district');
                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name').val(name);
                    modal.find('.modal-body #address_01').text(address1);
                    modal.find('.modal-body #address_02').text(address2);
                    modal.find('.modal-body #province').val(province);
                    $('body').find('h4').text('Update Outlet');
                    getDistricts(province,district);
                }
                else if(type==="Add")
                {
                    modal.find('.modal-body input[name!="vendor_id"]').val("");
                    modal.find('.modal-body textarea').text("");
                    modal.find('.modal-body select').val("");
                     $('body').find('h4').text('Add Outlet')

                }




            });


            $('#province').on('change',function(){

                var province_id = $(this).val();
               getDistricts(province_id);
            })

        function getDistricts(province_id,district = 0)
        {
             $.ajax({
                    url:'{{url('api/get_vendor_districts')}}'+'/'+province_id,
                    method:'get',
                    success:function (response) {

                       $('#district').html("");
                        $.each(response,function (index,value) {
                            if(value===district)
                                var option = '<option value="'+value+'" selected>'+index+'</option>';
                            else
                                var option = '<option value="'+value+'">'+index+'</option>';
                            $('#district').append(option);

                        })
                    }
                });
        }

    </script>
@endsection

