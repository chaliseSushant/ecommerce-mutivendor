@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <dl class="row">
                                        <dt class="col-sm-3">Total Amount</dt>
                                        <dd class="col-sm-3">Rs. {{$order_details->total_amount}}</dd>
                                        <dt class="col-sm-3">Discount</dt>
                                        <dd class="col-sm-3">{{$order_details->discount}}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3">Shipping Charge</dt>
                                        <dd class="col-sm-3">Rs.{{$order_details->shipping_charge}}</dd>
                                        <dt class="col-sm-3">Payable Amount</dt>
                                        <dd class="col-sm-3">Rs. {{$order_details->payable_amount}}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3">Paid Amount</dt>
                                        <dd class="col-sm-3">Rs. {{$order_details->paid_amount}}</dd>
                                        <dt class="col-sm-3">Delivery Note</dt>
                                        <dd class="col-sm-3">{{$order_details->delivery_note}}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3">Payment Method</dt>
                                        <dd class="col-sm-3">{{$order_details->payment_method}}</dd>
                                        @if($order_details->courier_id ==1)
                                            <dt class="col-sm-3">Courier</dt>
                                            <dd class="col-sm-3">{{$order_details->courier->name}}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Shipping Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        {{--<div class="col-12">
                                            <div class="vs-checkbox-con vs-checkbox-primary mb-2">
                                                <input class="privilege_check" id="multiple-person"  type="checkbox">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span> Multiple Person
                                            </div>
                                        </div>--}}
                                        <div class="col-12 ">
                                            <span class="font-weight-bold mb-1">Assign Shipping Person</span>
                                        </div>
                                        <div class="col-12 ">
                                            <form action="/dashboard/orders/assign_shipping_person/update" method="post" class="row">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{$order_details->id}}">
                                                <div class="col-12 form-group">
                                                    <select name="shipping_person" id="shipping_person" class="form-control full-width">
                                                        <option value="multiple_person">Multiple Person</option>

                                                    @foreach(\App\ShippingPerson::where('is_available','=',1)->get() as $shipping_person)
                                                            <option value="{{$shipping_person->id}}">{{$shipping_person->name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <button type="submit" class="btn btn-primary shipping">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Ordered Product List</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped">
                                    <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th>QTY</th>
                                        <th>RATE</th>
                                        <th>TOTAL</th>
                                        <th>ACCEPTED</th>
                                        <th>READY</th>
                                        <th>DISPATCHED</th>
                                        <th>DELIVERED</th>
                                        <th>ACTION</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_details->cart->cartItems as $order_items)
                                        <tr id="{{$order_items->id}}">
                                            <td>{{$order_items->product->name}}</td>
                                            <td>{{$order_items->quantity}}</td>
                                            <td>{{$order_items->product->price}}</td>
                                            <td>{{$order_items->quantity * $order_items->product->price}}</td>
                                            <td>
                                                @if($order_items->orderStatus->accepted)
                                                    <a href="{{url('/dashboard/order/cart_item/status/accept/'.$order_items->id)}}">{{\Carbon\Carbon::parse($order_items->orderStatus->accepted)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    <button class="btn btn-success btn-sm" type="accept">Accept</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order_items->orderStatus->ready)
                                                    <a href="#">{{\Carbon\Carbon::parse($order_items->orderStatus->ready)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    Not Ready
                                                @endif
                                            </td>
                                            <td>
                                                @if($order_items->orderStatus->dispatched)
                                                    <a href="{{url('/dashboard/order/cart_item/status/dispatch/'.$order_items->id)}}">{{\Carbon\Carbon::parse($order_items->orderStatus->dispatched)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    <button class="btn btn-info btn-sm" @if(!isset($order_items->orderStatus->accepted) || !isset($order_items->orderStatus->ready) ) disabled  @endif type="dispatch">Dispatch</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order_items->orderStatus->delivered)
                                                    <a href="{{url('/dashboard/order/cart_item/status/deliver/'.$order_items->id)}}">{{\Carbon\Carbon::parse($order_items->orderStatus->delivered)->format('d/m/Y h:m A')}}</a>
                                                @else
                                                    <button class="btn btn-warning btn-sm" @if(!isset($order_items->orderStatus->accepted) || !isset($order_items->orderStatus->ready) || !isset($order_items->orderStatus->dispatched) ) disabled  @endif type="deliver">Deliver</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" title="Edit" id="btn_update_cart_status" data-target="#modal_cart_status_edit" data-id="{{$order_items->id}}"><i class="feather icon-edit primary"></i></a>
                                                <a href="#" data-toggle="modal" title="Assign Shipping Person" class="cart_shipping" id="btn_update_cart_shipping" data-target="#modal_cart_shipping_edit" data-id="{{$order_items->id}}"><i class="feather icon-user-check warning"></i></a>
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
    <div class="modal fade text-left" id="modal_cart_shipping_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.cart_status_edit',['type'=>'Shipping Person'])
    </div>
    <script>
        $(function () {
            $('#modal_cart_status_edit').on('shown.bs.modal',function (e) {

                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                modal.find('.modal-body #id').val(id);

            });

            //if($('#shipping_person').val()==="multiple_person") $('.cart_shipping').show();

            $('#shipping_person').on('change',function () {
                if($(this).val()==="multiple_person")
                    $('.cart_shipping').show();
                else
                    $('.cart_shipping').hide();
            });





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
