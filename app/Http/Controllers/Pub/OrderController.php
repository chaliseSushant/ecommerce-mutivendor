<?php

namespace App\Http\Controllers\Pub;

use App\Cart;
use App\CartItem;
use App\CustomerAddress;
use App\District;
use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentGateway;
use App\Product;
use App\ShippingAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function cart()
    {
        if (Auth::user()->customer->addresses->count() >= 1){
            return view('frontend.pages.cart')
                ->with('carts', Auth::user()->carts->where('ordered',null));
        }
        else
        {
            return redirect('/customer/addresses');
        }

    }
    public function addToCart($product_id, Request $request)
    {
        if($request->quantity == null)
        {
            $qty = 1;
        }
        else
        {
            $qty = $request->quantity;
        }
        Product::find($product_id)->addToCart($qty, $request->instant);
        return redirect()->back();
    }
    public function updateCart(Request $request, $cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item != null)
        {
            if ($request->quantity != null)
            {
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
            }
        }
        return redirect()->back();

    }
    public function deleteCart($cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item != null)
        {
            $cart_id = $cart_item->cart->id;
            $cart_item->delete();
            $cart = Cart::find($cart_id);
            if ($cart->cartItems->count() == 0)
            {
                $cart->delete();
            }
            elseif($cart->deliverable_districts != null)
            {
                $limited_delivery = 0;
                $district = null;
                foreach ($cart->cartItems as $item)
                {

                    if ($item->is_instant == 1 || $item->product->national_delivery == 0)
                    {
                        $limited_delivery = 1;
                    }
                    if($district == null)
                    {
                        $district = $item->product->outlets->pluck('district_id')->toArray();
                    }
                    else
                    {
                        $district = array_intersect($district,$item->product->outlets->pluck('district_id')->toArray());
                    }
                }
                if ($limited_delivery == 1)
                {
                    $cart->deliverable_districts = implode(',',$district);
                }
                else
                {
                    $cart->deliverable_districts = null;
                }

                $cart->save();
            }
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }

    }
    public function checkout($cart_id)
    {
        $cart = Cart::where('id',$cart_id)->where('user_id', Auth::id())->where('ordered',null)->first();
        if ($cart == null)
        {
            return redirect()->back();
        }
        else
        {
            return view('frontend.pages.checkout-address')
                ->with('cart', Cart::find($cart_id));
        }
    }
    //Payment while checking out from cart
    public function checkoutPayment(Request $request, $cart_id)
    {
        $cart = Cart::find($cart_id);
        if ($cart == null || $cart->user_id != Auth::id())
        {
            return redirect()->back();
        }
        else{
            $ordered_cart = Order::where('cart_id',$cart_id)->first();
            if ($ordered_cart == null && $cart->ordered == 0)
            {
                if (isset($request->address))
                {
                    $c_add = CustomerAddress::find($request->address);
                    if($c_add == null){
                        return redirect()->back();
                    }
                    else
                    {
                        $shipping_amount = $cart->shipping($c_add->district_id); //Get A function to calculate shipping amount
                        $discount = $cart->discount();
                        $order = new Order();
                        $order->shipping_charge = $shipping_amount;
                        $order->total_amount =  $cart->subtotal();
                        $order->discount =  $discount;
                        $order->payable_amount =  $cart->subtotal()+$shipping_amount-$discount;
                        $order->cart_id = $cart_id;
                        $order->delivery_note = $request->delivery_note;
                        $order->user_id = Auth::id();
                        //$order->delivery_address = $address;
                        $order->save();

                        $shipping_address = new ShippingAddress();
                        $shipping_address->name = $c_add->name;
                        $shipping_address->phone = $c_add->phone;
                        $shipping_address->district_id = $c_add->district_id;
                        $shipping_address->address_01 = $c_add->address_01;
                        $shipping_address->address_02 = $c_add->address_02;
                        $shipping_address->order_id = $order->id;
                        $shipping_address->save();

                        $cart->ordered = Carbon::now();
                        $cart->save();
                        $cart->decreaseOnOrder();

                        foreach ($cart->cartItems as $item)
                        {
                            $cartItem = CartItem::find($item->id);
                            $cartItem->fee = ($cartItem->amount*$cartItem->commission())*100;
                            $cartItem->save();
                        }

                        return redirect('/order/checkout/payment/'.$order->id);
                    }
                }
                else
                {
                    return redirect()->back();
                }

            }
            else
            {
                return redirect()->back();
            }
        }
    }
    public function checkoutPay($order_id)
    {
        $order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
        if ($order == null)
        {
            return redirect('/');
        }
        else
        {
            return view('frontend.pages.checkout-payment')
                ->with('order',$order)
                ->with('paymentGateway', PaymentGateway::first());
        }
    }
}
