@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_shipping_person" data-target="#modal_add_new_shipping_person">Add New</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shipping_persons as $shipping_person)
                                        <tr>
                                            <td>{{$shipping_person->name}}</td>
                                            <td>{{$shipping_person->phone}}</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_shipping_person" data-target="#modal_update_shipping_person"
                                                   data-id="{{$shipping_person->id}}"
                                                   data-name="{{$shipping_person->name}}"
                                                   data-phone="{{$shipping_person->phone}}"
                                                   data-is_available="{{$shipping_person->is_available}}"
                                                   data-address="{{$shipping_person->address}}"

                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/shipping/person/delete')."/".$shipping_person->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_new_shipping_person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.shipping_person_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_shipping_person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.shipping_person_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_shipping_person').on('shown.bs.modal',function (e) {

                debugger;
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var name = link.data('name');
                var phone = link.data('phone');
                var is_available = link.data('is_available');
                var address = link.data('address');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #is_available').val(is_available);
                if(is_available === 0) modal.find('.modal-body #is_available').attr('checked',false);
                modal.find('.modal-body #phone').val(phone);
                modal.find('.modal-body #address').text(address);


            })
        })

    </script>

@endsection

