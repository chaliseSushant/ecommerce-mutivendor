@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone 1</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $vendor)
                                        <tr>
                                            <td>{{$vendor->name}}</td>
                                            <td>{{$vendor->phone}}</td>
                                            <td><div class="custom-control custom-switch switch-lg custom-switch-success" >
                                                    <input type="checkbox"  class="custom-control-input status" value="{{$vendor->id}}"  id="switch-{{$vendor->id}}">
                                                    <label class="custom-control-label" for="switch-{{$vendor->id}}">
                                                        <span class="switch-text-left">Approved</span>
                                                        <span class="switch-text-right">Inapproved</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_details_vendor" data-target="#modal_details_vendor"
                                                   data-id="{{$vendor->id}}"
                                                   data-name="{{$vendor->name}}"
                                                   data-commission="{{$vendor->email}}"
                                                   data-phone="{{$vendor->phone}}"
                                                   data-documents="{{$vendor->documents}}"
                                                   data-setting = "{{$vendor->setting}}"
                                                   title="View Details"><i class="feather icon-eye"></i></a>
                                                <a  href="{{url('/dashboard/vendors/add_edit')."/".$vendor->id}}" title="Edit Vendor"><i  class="feather icon-edit success"></i></a>
                                                <a  class="delete-confirm" href="{{url('/dashboard/vendor/delete')."/".$vendor->id}}" title="Delete Vendor"><i  class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_details_vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.vendor_approval_details')
    </div>
    <script>

        $(function () {
            $('#modal_details_vendor').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var name = link.data('name');
                var phone = link.data('phone');
                var email = link.data('email');
                var address = link.data('address');
                var documents = link.data('documents');
                var setting = link.data('setting');



                modal.find('.modal-body .name').text(name);
                modal.find('.modal-body .phone').text(phone);
                modal.find('.modal-body .email').text(email);
                modal.find('.modal-body .acc-name').text(setting.account_name);
                modal.find('.modal-body .acc-number').text(setting.account_number);
                modal.find('.modal-body .bank-name').text(setting.bank_name);
                modal.find('.modal-body .bank-branch').text(setting.branch);
                modal.find('.modal-body .address').text(address);
                if(documents.length>0)
                {
                    $('.documents').html("");
                    for(var i=0;i<documents.length;i++)
                    {
                        modal.find('.modal-body .documents').append('<a href="'+documents[i].url+'" target="blank"><img src="'+documents[i].url+'" style="height: 130px; width:130px; margin-left:5px"></a>');
                    }
                }
                else
                    modal.find('.modal-body .documents').text('No Documents Uploaded')

            })

            $('.status').on('change',function () {
                var value = $(this).val();
                if($(this).is(':checked') === true)
                {
                    var url = "{{url('dashboard/vendor/approve_vendor/')."/"}}"+value;
                }

                $.ajax({
                    url:url,
                    method:'get',
                    success:function (response) {
                        if(response.type ==="update")
                            toastr.success(response.message);
                        else
                            toastr.error(response.message);

                        location.reload()
                    }
                });
            });
        })

    </script>


@endsection
