<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\VendorType;
use Illuminate\Http\Request;

class VendorTypeController extends Controller
{
    public function index()
    {
        $vendor_types = VendorType::all();
        return view('dashboard.pages.vendor_types')->with(['vendorTypes'=>$vendor_types,'name'=>'Vendor Types']);
    }

    public function store(Request $request)
    {
        $vendor_type = isset($request->id)?VendorType::findOrFail($request->id):new VendorType();
        $vendor_type->title = $request->title;
        $vendor_type->icon = $request->icon;
        $vendor_type->save();
        return redirect('/dashboard/vendor-types');
    }

    public function destroy($id)
    {
        $vendor_type = VendorType::findOrFail($id);
        $vendor_type->delete();
        return redirect('dashboard/vendor-types');
    }
}
