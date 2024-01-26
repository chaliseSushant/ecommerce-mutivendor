<?php

namespace App\Http\Controllers\Dashboard;

use App\DiscountSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {

        $discount_settings = DiscountSetting::first();

        return view('dashboard.pages.discount_settings')->with(['name'=>'Discount Settings','discount_settings'=>$discount_settings]);
    }

    public function enableDiscount($type)
    {
        $discount_settings = DiscountSetting::first();
        $value = $discount_settings->$type;
        if($value == 1)
            $discount_settings->$type = 0;
        elseif ($value== 0)
            $discount_settings->$type = 1;

        $discount_settings->save();
        return redirect()->back();
    }

    public function updateDiscount(Request $request)
    {
        $discount_settings = DiscountSetting::first();

        if($discount_settings->fp_enabled == 1 && $request->discount_type == "fp")
        {
            $discount_settings->fp_min = $request->fp_min;
            $discount_settings->fp_discount = $request->fp_discount;
            $discount_settings->duration = $request->duration;
        }
        if($discount_settings->rfr_enabled == 1 && $request->discount_type == "rfr")
        {
            $discount_settings->rfr_min = $request->rfr_min;
            $discount_settings->rfr_discount = $request->rfr_discount;
            $discount_settings->rfr_duration = $request->rfr_duration;
        }
        if($discount_settings->rfd_enabled == 1 && $request->discount_type == "rfd")
        {
            $discount_settings->rfd_min = $request->rfd_min;
            $discount_settings->rfd_discount = $request->rfd_discount;
            $discount_settings->rfd_duration = $request->rfd_duration;
        }

        $discount_settings->save();
        return redirect()->back();

    }
}
