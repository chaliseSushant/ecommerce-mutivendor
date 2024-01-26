<form action="{{url('/order/checkout/payment/cod/confirm/'.$order->id)}}" method="get">
    @csrf
    <input value="{{$order->payable_amount}}" name="tAmt" type="hidden">
    <input class="btn btn-warning cod-pay" value="Cash On Delivery" type="submit">
</form>
