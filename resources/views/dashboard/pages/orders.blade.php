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
                            <th>ORDER ID</th>
                            <th>CUSTOMER</th>
                            <th>PHONE No</th>
                            <th style="width:30%">DELIVERY ADDRESS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td class="product-name">{{$order->user->name}}</td>
                            <td class="product-name">{{$order->address->phone}}</td>
                            <td style="width:30%">{{$order->address->name}},{{$order->address->district->name}}, {{$order->address->district->province->name}}
                                , {{$order->address->address_01}}, {{$order->address->address_02}}
                            </td>
                            <td class="product-action ">
                                <a class="btn btn-success" href="{{url('/dashboard/orders/cart/'.$order->id)}}"><i class="feather icon-eye"></i></a>
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
@endsection
