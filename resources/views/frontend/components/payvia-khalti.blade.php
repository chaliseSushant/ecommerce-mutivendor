<!-- Place this where you need payment button -->
<button id="payment-button" class="khalti-pay">Pay with Khalti</button>
@csrf
<!-- Place this where you need payment button -->
<!-- Paste this code anywhere in you body tag -->
<script>
    var config = {
        // replace the publicKey with yours
        //"publicKey": "test_public_key_b863bb6e6ab1405eafcb64ce4a7b1020",
        "publicKey": "{{$paymentGateway->khalti_public_key}}",
        "productIdentity": "{{$order->id}}",
        "productName": "Purchased Via {{config('app.name')}}",
        "productUrl": "{{url('/customer/order/'.$order->id)}}",
        "eventHandler": {
            onSuccess (payload) {
                var root = location.protocol + '//' + location.host;
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url:root+'/order/checkout/payment/khalti/confirm/{{$order->id}}',
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: {
                        'token':payload.token,
                        'amount':payload.amount
                    }})
                ;
                },
            onError (error) {
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        checkout.show({amount: {{$order->payable_amount*100}}});
    }
</script>
<!-- Paste this code anywhere in you body tag -->
