@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table data-thumb-view">
                        <thead>
                        <tr>
                            <th></th>
                            <th>USER</th>
                            <th style="width:30%">DELIVERY ADDRESS</th>
                            <th>ORDER STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td></td>
                            <td class="product-name">{{$order->user->name}}</td>
                            <td style="width:30%">@if($order->courier_id ==1) {{$order->courier->name}} @else {{$order->delivery_address}} @endif</td>
                            <td class="action-edit">

                                <div class="chip chip-warning">
                                    <div class="chip-body">
                                        <div class="chip-text">{{$order->orderStatus->name}}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="product-action ">
                                <a class="btn btn-success" href="{{url('/dashboard/store/order/')."/".$order->id}}"><i class="feather icon-eye"></i></a>
                                <a class="btn btn-primary"
                                   id="btn_update_order_status"
                                   href="#"
                                   data-toggle="modal"
                                   data-target="#modal_edit_orderstatus"
                                    data-id="{{$order->id}}"
                                   ><i class="feather icon-edit"></i></a>

                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </section>
    <div class="modal fade text-left" id="modal_edit_orderstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.order_status_edit')
    </div>
    <script>
        $(function () {
            $('#modal_edit_orderstatus').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');

                modal.find('.modal-body #id').val(id);

            })
        })
    </script>
@endsection
