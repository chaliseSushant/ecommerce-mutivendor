<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $payment_gateways = PaymentGateway::first();

        return view('dashboard.pages.payment_gateway')->with(['payment_gateway'=>$payment_gateways,'name'=>'Payment Gateways']);
    }

    public function updatePaymentGateway(Request $request)
    {
        $payment_gateway = isset($request->id)?PaymentGateway::findOrFail($request->id):new PaymentGateway();

        if($request->type =="esewa" )
        {
            $payment_gateway->esewa_enable = $request->enable_esewa == "on"?1:0;
            $payment_gateway->esewa_secret_key  = $request->esewa_secret_key;
            $payment_gateway->esewa_public_key  = $request->esewa_public_key;
        }

        if($request->type =="khalti")
        {

            $payment_gateway->khalti_enable = $request->enable_khalti == "on"?1:0;
            $payment_gateway->khalti_secret_key  = $request->khalti_secret_key;
            $payment_gateway->khalti_public_key  = $request->khalti_public_key;
        }
        if($request->type =="fonepay")
        {
            $payment_gateway->fonepay_enable = $request->fonepay_enable == "on"?1:0;
            if($request->hasFile('fonepay_qr'))
            {

                request()->validate([
                    'fonepay_qr' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = "fonepay".".".$request->fonepay_qr->getClientOriginalExtension();
                $request->fonepay_qr->move(public_path('images/fonepay'), $imageName);
                $payment_gateway->fonepay_qr = url('images/fonepay')."/".$imageName;

            }
        }
        $payment_gateway->save();
        return redirect('/dashboard/payment-gateways');
    }


}
