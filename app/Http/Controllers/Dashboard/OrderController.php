<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\SystemNotifier;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('payment_complete',1)->get();

        return view('dashboard.pages.orders')->with(['orders'=>$orders,'name'=>"Orders"]);
    }


    public function orderHistory()
    {
       $order_histories = Order::join('carts','carts.id','=','orders.cart_id')
        ->join('cart_items','carts.id','=','cart_items.cart_id')
        ->join('order_statuses','order_statuses.id','=','cart_items.order_status_id')
        ->where('order_statuses.delivered','<>',null)
        ->Orwhere('order_statuses.cancelled','<>',null)
        ->Orwhere('order_statuses.rejected','<>',null)->get();

        return view('dashboard.pages.order_histories')->with(['order_histories'=>$order_histories,'name'=>"Order History"]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status_id = $request->order_status_id;
        $order->save();

        $data = [
            'target_url' => "/cart",
            'message' => $order->orderStatus->description
        ];
        Notification::send($order->user, new SystemNotifier($data));

        return redirect('/dashboard/store/orders');
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $orders = Order::findOrFail($order_id);
        return view('dashboard.pages.modals.ordered_cart_details')->with(['order_details'=>$orders,'name'=>'Order Details']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
