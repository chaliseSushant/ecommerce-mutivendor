<form action="{{url('/')}}" method="POST">
    @csrf
    <input value="{{$order->payable_amount}}" name="tAmt" type="hidden">
    <input class="btn btn-fonepay cod-pay" value="Fonepay Direct - Scan" type="submit">
</form>
