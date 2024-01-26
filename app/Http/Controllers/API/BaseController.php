<?php

namespace App\Http\Controllers\API;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\Privilege;
use App\Province;
use App\Role;
use App\Store;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    
    public function getProvinces()
    {
        return Province::where('is_enabled',1)->get()->sortBy('code');
    }
    public function getDistricts($province_id)
    {
        $districts = District::where('is_enabled',1)->where('province_id',$province_id)->orderBy('name','asc')->pluck('id','name');
        return response()->json($districts);
    }
    public function getVendorDistricts($province_id)
    {
        $districts = District::where('is_enabled_vendor',1)->where('province_id',$province_id)->orderBy('name','asc')->pluck('id','name');
        return response()->json($districts);
    }
    public function addPrivilege(Request $request)
    {
        $pid = explode('_',$request->identifier)[0];
        $rid = explode('_',$request->identifier)[1];
        Role::find($rid)->privileges()->attach(Privilege::find($pid));
        return response('Privilege granted to role successfully.',200);
    }
    public function removePrivilege(Request $request)
    {
        $pid = explode('_',$request->identifier)[0];
        $rid = explode('_',$request->identifier)[1];
        Role::find($rid)->privileges()->detach(Privilege::find($pid));
        return response('Privilege removed from role successfully.',200);
    }
}
