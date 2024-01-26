<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\PaymentApi;
use App\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentApiController extends Controller
{

    public function index()
    {
        $payment_apis = Auth::user()->store->paymentGateway;

        return view('dashboard.pages.payment_api')->with(['payment_api'=>$payment_apis,'name'=>'Payment APIs']);
    }

    public function updatePaymentApi(Request $request)
    {
        $payment_api = isset($request->id)?PaymentGateway::findOrFail($request->id):new PaymentGateway();

        $store_id = Auth::user()->store->id;
        if($request->type =="esewa" && $request->enable_esewa == "on")
        {
            $payment_api->esewa_enable = 1;
            $payment_api->esewa_secret_key  = $request->esewa_secret_key;
            $payment_api->esewa_public_key  = $request->esewa_public_key;
        }

        if($request->type =="khalti" && $request->enable_khalti == "on")
        {

            $payment_api->khalti_enable = 1;
            $payment_api->khalti_secret_key  = $request->khalti_secret_key;
            $payment_api->khalti_public_key  = $request->khalti_public_key;
        }
        if($request->type =="fonepay" && $request->enable_fonepay == "on")
        {

            if($request->hasFile('fonepay_qr'))
            {

                request()->validate([
                    'fonepay_qr' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = $store_id.'_'."fonepay".".".$request->fonepay_qr->getClientOriginalExtension();
                $request->fonepay_qr->move(public_path('images/stores/fonepay'), $imageName);
                $payment_api->fonepay_qr = url('images/stores/fonepay')."/".$imageName;
                $payment_api->fonepay_enable = 1;
            }
        }
        $payment_api->store_id = $store_id;
        $payment_api->save();
        return redirect('/dashboard/store/payment-apis');
    }

    public function destroy(PaymentApi $paymentApi)
    {
        //
    }
}
