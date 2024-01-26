<?php

namespace App\Http\Controllers\Pub;

use App\CartItem;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function khaltiValidate(Request $request, $order_id)
    {
        $args = http_build_query(array(
            'token' => $request->token,
            'amount' => $request->amount,
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key ' . Order::find($order_id)->store->paymentGateway->khalti_secret_key];
        //$headers = ['Authorization: Key test_secret_key_8aff8ac4f964496495d57d0c7772328d'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        //Convert Response JSON to Collection
        $resp_message = collect(json_decode($response));

        //Get Paid Amount & Divide by 100 & Set In database & compare with payable amount
        //Set Order Status, Payment Complete to 1, Payment Method To Khalti
        $paid_amount = ($resp_message['amount']) / 100;
        $order = Order::find($order_id);
        if ($order != null) {
            $order->paid_amount = $paid_amount;
            if ($order->payable_amount > $paid_amount) {
                $order->order_status_id = OrderStatus::where('name', 'Partially Paid')->first()->id;
                $message = 'Partially Paid. Order has not successfully been placed. Please contact store.';
            } else {
                $order->order_status_id = OrderStatus::where('name', 'Payment Verified')->first()->id;
                $order->payment_complete = 1;
                $message = 'Payment Completed & Verified. Order has been placed.';
            }
            $order->payment_method = 'Khalti';
            $order->save();
            $this->assignAmountToCartItems($order->cart->cartItems);
            return response($message, 200);
        } else {
            return response('Error. You cannot place order.', 404);
        }


    }

    public function esewaValidate()
    {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data = [
            'amt' => 100,
            'rid' => '000AE01',
            'pid' => 'ee2c3ca1-696b-4cc5-a6be-2c40d929d453',
            'scd' => 'epay_payment'
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function codValidate($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->where('payment_complete', 0)->first();
        if ($order == null) {

            return redirect()->back();
        } else {
            $this->assignOrderStatus($order);
            $order->payment_method = 'cod';
            $order->payment_complete = 1;
            $this->assignAmountToCartItems($order->cart->cartItems);
            $order->save();
            return redirect()->route('customer-orders');

        }
    }

    public function assignOrderStatus($order)
    {
        foreach ($order->cart->cartItems as $cartItem) {
            $order_status = new OrderStatus;
            $order_status->save();
            $cartItem->order_status_id = $order_status->id;
            $cartItem->save();
        }
    }

    public function assignAmountToCartItems($cartItems)
    {
        foreach ($cartItems as $cart_item)
        {
            $item = CartItem::find($cart_item->id);
            $item->amount = $cart_item->product->price*$cart_item->quantity;
            $item->fee = ($cart_item->product->price*$cart_item->quantity*$cart_item->product->commission_assignable())/100;
            $item->save();
        }
    }

}
