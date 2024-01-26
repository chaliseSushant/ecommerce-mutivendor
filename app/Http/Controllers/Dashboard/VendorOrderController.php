<?php

namespace App\Http\Controllers\Dashboard;

use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index()
    {

        $orders = CartItem::whereHas('product', function ($query) {
            return $query->where('vendor_id', '=', 1);
                })->whereHas('orderStatus',function ($query) {
            return $query->whereNotNull('accepted')
                ->whereNull(['dispatched','delivered','cancelled','rejected'])
                ;})->get();

        return view('dashboard.pages.modals.vendor_order_cart_items')->with(['name'=>'Vendor Order','orders'=>$orders]);
    }
}
