<?php

namespace App\Http\Controllers\Pub;

use App\Customer;
use App\CustomerAddress;
use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function setNotificationCookie()
    {
        Cookie::queue(Cookie::make('notif', Auth::user()->unreadNotifications, 60*24));
        return response('Notification Set in Cookie', 200);
    }
    public function getNotificationFromCookie()
    {
        dd(Cookie::get('notif'));
    }
    public function account()
    {
        return view('frontend.pages.customer-account');
    }
    public function addresses()
    {
        $addresses = Auth::user()->customer->addresses;
        return view('frontend.pages.addresses')
            ->with('addresses',$addresses);
    }
    public function addAddress(Request $request)
    {
        if (isset($request->id))
        {
            $addr = CustomerAddress::where('id',$request->id)->where('customer_id',Auth::user()->customer->id)->first();
            if ($addr == null)
            {
                return redirect()->back();
            }
            else
            {
                $addr->name = $request->name;
                $addr->phone = $request->phone;
                $addr->district_id = $request->district;
                $addr->address_01 = $request->line1;
                $addr->address_02 = $request->line2;
                if (isset($request->is_default))
                {
                    $addr->default = 1;
                    $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->get();
                    foreach ($customer_add as $address)
                    {
                        $address->default = 0;
                        $address->save();
                    }
                }
                else
                {
                    $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->where('default',1)->first();
                    if ($customer_add == null)
                    {
                        $addr->default = 1;
                    }
                    else
                    {
                        $addr->default = 0;
                    }
                }
                $addr->save();
            }
        }
        else
        {
            $addr = new CustomerAddress();
            $addr->name = $request->name;
            $addr->phone = $request->phone;
            $addr->district_id = $request->district;
            $addr->address_01 = $request->line1;
            $addr->address_02 = $request->line2;
            $addr->customer_id = Auth::user()->customer->id;
            if (isset($request->is_default))
            {
                $addr->default = 1;
                $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->get();
                foreach ($customer_add as $address)
                {
                    $address->default = 0;
                    $address->save();
                }
            }
            else
            {
                $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->where('default',1)->first();
                if ($customer_add == null)
                {
                    $addr->default = 1;
                }
                else
                {
                    $addr->default = 0;
                }
            }
            $addr->save();
        }

        return redirect('/customer/addresses');
    }
    public function setDefaultAddress($address_id)
    {
        $c_add = CustomerAddress::where('id',$address_id)->where('customer_id', Auth::user()->customer->id)->first();
        if ($c_add != null)
        {
            $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->get();
            foreach ($customer_add as $address)
            {
                $address->default = 0;
                $address->save();
            }
            $c_add->default = 1;
            $c_add->save();
        }
        return redirect('/customer/addresses');

    }
    public function deleteAddress($address_id)
    {
        $c_add = CustomerAddress::where('id',$address_id)->where('customer_id', Auth::user()->customer->id)->first();
        if ($c_add != null)
        {
            $c_add->delete();
        }
        return redirect('/customer/addresses');
    }
    public function security()
    {
        return view('frontend.pages.customer-security');
    }
    public function updatePassword(Request $request)
    {
        if ($request->password = $request->c_password)
        {
            $user = User::find(Auth::id());
            if ($user->password == null)
            {
                $user->password = Hash::make($request->password);
                $user->save();
            }
            else
            {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                }
            }
        }
        return redirect()->back();
    }
    public function updateEmail(Request $request)
    {
        if ($request->email != Auth::user()->email || $request->email != null)
        {
            $user = User::find(Auth::id());
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->save();
        }
        return redirect()->back();
    }
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $customer = $user->customer;
        if ($request->name !=$user->name || $request->name != null)
        {
            $user->name = $request->name;
        }
        if ($request->gender != $customer->gender)
        {
            $customer->gender = $request->gender;
        }
        if ($request->phone != $customer->phone || $request->phone != null)
        {
            $customer->phone = $request->phone;
        }
        $user->save();
        $customer->save();
        return redirect()->back();
    }
    public function orders()
    {
        $orders = Auth::user()->orders->sortByDesc('created_at');
        return view('frontend.pages.customer-orders')
            ->with('orders',$orders);
    }
    public function orderDetail($id)
    {
        $order = Auth::user()->orders->where('id',$id)->first();
        if (isset($order))
        {
            return view('frontend.pages.order-detail')
                ->with('order',$order);
        }
        else
        {
            return redirect()->back();
        }

    }
}
