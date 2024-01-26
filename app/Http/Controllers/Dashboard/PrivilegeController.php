<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Privilege;
use App\Role;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $privileges = Privilege::all();

        return view('dashboard.pages.privileges')
            ->with([
                'name'=>'Privileges',
                'privileges'=>$privileges,
                'roles'=>$roles
            ]);
    }
    public function addPrivilege($id)
    {

        $pid = explode('_',$id)[0];
        $rid = explode('_',$id)[1];
        Role::find($rid)->privileges()->attach(Privilege::find($pid));

        return response('Privilege granted to role successfully.',200);
    }
    public function removePrivilege($id)
    {
        $pid = explode('_',$id)[0];
        $rid = explode('_',$id)[1];
        Role::find($rid)->privileges()->detach(Privilege::find($pid));
        return response('Privilege removed from role successfully.',200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $privilege = new Privilege();
        $privilege->name = $request->name;
        $privilege->privilege = $request->privilege;
        $privilege->description = $request->description;

        $privilege->save();
        return redirect('/dashboard/privileges');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilege $privilege)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privilege $privilege)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        //
    }
}
