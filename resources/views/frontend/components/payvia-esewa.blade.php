<form action="https://uat.esewa.com.np/epay/main" method="POST">
    <input value="{{$order->payable_amount}}" name="tAmt" type="hidden">
    <input value="{{$order->payable_amount}}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="epay_payment" name="scd" type="hidden">
    <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
    <input value="{{url('/order/checkout/payment/esewa/confirm/'.$order->id)}}" type="hidden" name="su">
    <input value="{{url('/order/checkout/payment/'.$order->id)}}" type="hidden" name="fu">
    <input class="esewa-pay" value="Pay with eSewa" type="submit">
</form>
