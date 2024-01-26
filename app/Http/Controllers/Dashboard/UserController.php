<?php

namespace App\Http\Controllers\Dashboard;


use App\Role;
use App\User;
use App\Store;
use App\Vendor;
use App\ConfirmationMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    public function index()
    {
        $user = new User();
        $users = $user->get();
        $roles = Auth::user()->assignableRoles();
        $vendors = Vendor::all('id', 'name');

        return view('dashboard.pages.users')->with('name', 'Users')->with('users', $users)->with(['roles' => $roles, 'vendors' => $vendors]);
    }

    public function storeAdmin()
    {
        $store_admins = Role::where('role', 'store_admin')->first()->users;
        $stores = Store::all('id', 'name');
        return view('dashboard.pages.store_admin')->with(['store_admins' => $store_admins, 'areas' => $areas, 'stores' => $stores, 'name' => 'Store Administrator']);
    }

    public function saveUpdateUser(Request $request)
    {

        $vendor_admin = isset($request->id) ? User::findOrFail($request->id) : new User();
        if (!isset($request->id))
            $vendor_admin->password = Hash::make($request->password);
        $vendor_admin->name = $request->name;
        $vendor_admin->email = $request->email;
        $vendor_admin->vendor_id = $request->vendor_id <= 0 ? null : $request->vendor_id;
        $vendor_admin->role_id = $request->role_id;
        if ($vendor_admin->save())
            $message = isset($request->id) ? ['message' => ConfirmationMessage::$updateVendorAdminSuccessMessage, 'type' => 'update'] : ['message' => ConfirmationMessage::$saveVendorAdminSuccessMessage, 'type' => 'save'];
        else
            $message = ['message' => ConfirmationMessage::$errorVendorAdminSuccessMessage];
        return redirect()->back()->with('messages', $message);
    }

    public function storeEmployee()
    {
        $store_employee = Auth::user()->store->employees();
        return view('dashboard.pages.employees')->with(['employees' => $store_employee, 'name' => 'Store Employees']);
    }

    public function saveStoreEmployee(Request $request)
    {

        $employee = isset($request->id) ? User::findOrFail($request->id) : new User();
        if (!isset($request->id))
            $employee->password = Hash::make($request->password);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->store_id = Auth::user()->store->id;
        $employee->role_id = Role::where('role', 'employee')->first()->id;

        if ($employee->save())
            $message = isset($request->id) ? ['message' => ConfirmationMessage::$updateEmployeeSuccessMessage, 'type' => 'update'] : ['message' => ConfirmationMessage::$saveEmployeeSuccessMessage, 'type' => 'save'];
        else
            $message = ['message' => ConfirmationMessage::$errorEmployeeSuccessMessage];
        return redirect()->back()->with('messages', $message);
    }

    public function changePasswordIndex()
    {
        return view('dashboard.pages.password-reset')->with('name', 'Password Reset');
    }


    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with('messages', ["type" => "error", "message" => "Your current password does not matches with the password you provided"]);
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with('messages', ['type' => "error", 'message' => "New Password cannot be same as your current password"]);
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required|string|min:6|same:new_password',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect('/logout')->with('messages', ['type' => "update", 'message' => "Password changed successfully !"]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
