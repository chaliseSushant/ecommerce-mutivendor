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
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SKU</th>
                                        <th>PRODUCT</th>
                                        <th>QTY</th>
                                        <th>RATE</th>
                                        <th>TOTAL</th>
                                        <th>READY</th>
                                        <th>REJECT</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr id="{{$order->id}}">
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->product->sku}}</td>
                                            <td><a>{{$order->product->name}}</a></td>
                                            <td>{{$order->quantity}}</td>
                                            <td>{{$order->product->price}}</td>
                                            <td>{{$order->quantity * $order->product->price}}</td>
                                            <td>
                                                @if($order->orderStatus->ready)
                                                    <a href="{{url('/dashboard/order/cart_item/status/ready/'.$order->id)}}">{{\Carbon\Carbon::parse($order->orderStatus->ready)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    <button class="btn btn-success btn-sm" type="ready">Ready</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->orderStatus->rejected)
                                                    <a href="{{url('/dashboard/order/cart_item/status/rejected/'.$order->id)}}">{{\Carbon\Carbon::parse($order->orderStatus->rejected)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    <button class="btn btn-danger btn-sm"  type="reject">Reject</button>
                                                @endif
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
    <div class="modal fade text-left" id="modal_cart_status_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.cart_status_edit',['type'=>'Status'])
    </div>
    <script>
        $(function () {

            $('body').find('button').on('click',function () {
                var cart_id = $(this).closest('tr').attr('id');
                var type = $(this).attr('type');
                $.ajax({
                    url:'/dashboard/order/cart_item/status/'+type+'/'+cart_id,
                    method:'get',
                    success:function () {
                        location.reload(true);
                        toastr.success('Status updated successfully')
                    }
                })
            })
        })
    </script>
@endsection
