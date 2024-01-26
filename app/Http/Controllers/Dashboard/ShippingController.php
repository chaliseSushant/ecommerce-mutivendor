<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\ShippingPerson;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shipping_persons = ShippingPerson::all();
        return view('dashboard.pages.shipping_person')->with(['shipping_persons'=>$shipping_persons,'name'=>"Shipping Persons"]);
    }
    public function store(Request $request)
    {

        $shipping_person = isset($request->id) ? ShippingPerson::findOrFail($request->id) : new ShippingPerson();
        $shipping_person->name = $request->name;
        $shipping_person->phone = $request->phone;
        $shipping_person->is_available = isset($request->is_available)?1:0;
        $shipping_person->address = $request->address;

        $shipping_person->save();

        return redirect()->back();
    }
}
