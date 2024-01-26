<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $shipping_settings = Setting::first();
        return view('dashboard.pages.general_settings')->with(['name'=>'General Settings','shipping_setting'=>$shipping_settings]);
    }

    public function store(Request $request)
    {
        $shipping_setting = Setting::first();
        $shipping_setting->shipping_type = $request->shipping_type;
        $shipping_setting->default_shipping_charge = $request->default_shipping_charge;
        $shipping_setting->minimum_order_amount = $request->minimum_order_amount;
        $shipping_setting->save();
        return redirect('dashboard/general-settings');
    }
}
