<?php

namespace App\Http\Controllers\Dashboard;

use App\CartItem;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function vendor_transaction_report(Request $request)
    {

        if(isset($request->daterange))
        {
            $date = explode('-',$request->daterange);
            $start = date('yy-m-d H:i:s', strtotime($date[0]));
            $end = date('yy-m-d H:i:s', strtotime($date[1]));
        }
        else{
            $start = date('yy-m-d H:i:s', strtotime('2020-1-1 00:00:00'));;
            $end = Carbon::now();
        }

        $data = DB::table('cart_items')->leftJoin('products','cart_items.product_id','=','products.id')
            ->leftJoin('vendors','products.vendor_id','=','vendors.id')
            ->leftJoin('order_statuses','order_statuses.id','=','cart_items.order_status_id')
            ->whereNotNull('order_statuses.delivered')
            ->whereDate('cart_items.created_at','>=',$start)
            ->whereDate('cart_items.created_at','<=',$end)
            ->select('products.sku as sku','products.name as product_name','vendors.name as vendor_name','cart_items.quantity','cart_items.amount','cart_items.fee','cart_items.amount')->get();

        return view('dashboard.pages.reports.vendor_transaction_report')->with(['name'=>'Vendor Transaction Report','datas'=>$data]);
    }

    public function all_vendor_transaction_report(Request $request)
    {
        if(isset($request->daterange))
        {
            $date = explode('-',$request->daterange);
            $start = date('yy-m-d H:i:s', strtotime($date[0]));
            $end = date('yy-m-d H:i:s', strtotime($date[1]));
        }
        else{
            $start = date('yy-m-d H:i:s', strtotime('2020-1-1 00:00:00'));;
            $end = Carbon::now();
        }

        $data = DB::table('vendors')->leftJoin('products','products.vendor_id','=','vendors.id')
            ->leftJoin('cart_items','cart_items.product_id','=','products.id')
            ->leftJoin('order_statuses','order_statuses.id','=','cart_items.order_status_id')
            ->whereNotNull('order_statuses.delivered')
            ->whereDate('cart_items.created_at','>=',$start)
            ->whereDate('cart_items.created_at','<=',$end)
            ->select('vendors.name as vendor_name',DB::raw('SUM(amount) as amount'),DB::raw('SUM(fee) as fee'))->groupBy('vendors.name')->get();

        return view('dashboard.pages.reports.all_vendor_transaction_report')->with(['name'=>'All Vendor Transaction Report','datas'=>$data]);


    }

    public function orders_by_paymentmethod(Request $request)
    {
        if(isset($request->daterange))
        {
            $date = explode('-',$request->daterange);
            $start = date('yy-m-d H:i:s', strtotime($date[0]));
            $end = date('yy-m-d H:i:s', strtotime($date[1]));
        }
        else{
            $start = date('yy-m-d H:i:s', strtotime('2020-1-1 00:00:00'));;
            $end = Carbon::now();
        }
        $data = DB::table('orders')->leftJoin('cart_items','cart_items.cart_id','=','orders.cart_id')
            ->leftJoin('order_statuses','order_statuses.id','=','cart_items.order_status_id')
            ->whereNotNull('order_statuses.delivered')
            ->whereDate('orders.created_at','>=',$start)
            ->whereDate('orders.created_at','<=',$end)
            ->select(DB::raw('orders.payment_method as method,SUM(cart_items.amount) as amount,SUM(cart_items.fee) as fee'))->groupBy('orders.payment_method')->get();

        return view('dashboard.pages.reports.payment_method_report')->with(['name'=>'Payment Method Report','datas'=>$data]);
    }

    public function sales_by_vendor(Request $request)
    {
        if(isset($request->daterange))
        {
            $date = explode('-',$request->daterange);
            $start = date('yy-m-d H:i:s', strtotime($date[0]));
            $end = date('yy-m-d H:i:s', strtotime($date[1]));
        }
        else{
            $start = date('yy-m-d H:i:s', strtotime('2020-1-1 00:00:00'));;
            $end = Carbon::now();
        }
        $vendor_id = Auth::user()->vendor_id;
        $data = DB::table('cart_items')->leftJoin('products','cart_items.product_id','=','products.id')
            ->leftJoin('order_statuses','order_statuses.id','=','cart_items.order_status_id')
            ->where('products.vendor_id','=',$vendor_id)
            ->whereNotNull('order_statuses.delivered')
            ->whereDate('cart_items.created_at','>=',$start)
            ->whereDate('cart_items.created_at','<=',$end)
            ->select('products.sku as sku','products.name as product_name','cart_items.quantity','cart_items.amount','cart_items.fee','cart_items.amount')->get();

        return view('dashboard.pages.reports.vendor_sales_report')->with(['name'=>'Vendor Sales Report','datas'=>$data]);

    }
}
