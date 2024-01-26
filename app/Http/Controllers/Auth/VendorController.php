<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Vendor;
use App\VendorSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function init()
    {
        return view('auth.register-vendor');
    }
    public function register(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'vendor_name' => ['required'],
            'vendor_phone' => ['required'],
            'vendor_email' => ['required'],
            'vendor_address' => ['required']
        ]);
        $vendor = new Vendor();
        $vendor->name = $validatedRequest['vendor_name'];
        $vendor->phone = $validatedRequest['vendor_phone'];
        $vendor->email = $validatedRequest['vendor_email'];
        $vendor->address = $validatedRequest['vendor_address'];
        $vendor->alt_phone = $request->vendor_phone_2;
        $vendor->save();
        $user = User::create([
            'name' => $validatedRequest['name'],
            'email' => $validatedRequest['email'],
            'password' => Hash::make($validatedRequest['password']),
        ]);
        $user->role_id = Role::where('role','vendor')->first()->id;
        $user->vendor_id = $vendor->id;
        $user->save();
        $vendor_setting = new VendorSetting();
        $vendor_setting->vendor_id = $vendor->id;
        $vendor_setting->save();
        Auth::login($user);
        return redirect('/dashboard');

    }
}
