<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index($id)
    {
        $orders = Order::find($id);
        return view('dashboard.pages.modals.ordered_cart_details')->with(['order_details'=>$orders,'name'=>'Order Details']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($type,$cart_item_id,$datetime=null)
    {
        $status = CartItem::findOrFail($cart_item_id)->orderStatus;

        switch ($type){
            case "accept":
                $status->accepted = isset($status->accepted)?null:Carbon::now();
                break;
            case "ready":
                $status->ready = isset($status->ready)?null:Carbon::now();
                break;
            case "dispatch":
                $status->dispatched = isset($status->dispatched)?null:Carbon::now();
                break;
            case "deliver":
                $status->delivered = isset($status->delivered)?null:Carbon::now();
                break;
            case "cancel":
                $status->canceled = isset($status->canceled)?null:Carbon::now();
                break;
            case "reject":
                $status->rejected = isset($status->rejected)?null:Carbon::now();
                break;


        }

        $status->save();
        return redirect()->back();
    }

    public function reUpdateStatus(Request $request)
    {
        $status = CartItem::findOrFail($request->id)->orderStatus;
        if($request->type=="accept"){

            $status->accepted = Carbon::parse($request->datetime)->format('Y/m/d h:m:s');

        }
        elseif($request->type=="dispatch")
        {
            $status->dispatched = Carbon::parse($request->datetime)->format('Y/m/d h:m:s');;
        }
        elseif($request->type=="deliver")
        {
            $status->delivered = Carbon::parse($request->datetime)->format('Y/m/d h:m:s');;
        }
        $status->save();
        return redirect()->back();
    }

    public function assignShippingPerson(Request $request)
    {

        $order_details = CartItem::where('cart_id',$request->cart_id)->get();
        foreach ($order_details as $order_detail)
        {
            $order_detail->shipping_person_id = $request->shipping_person;
            $order_detail->save();
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
