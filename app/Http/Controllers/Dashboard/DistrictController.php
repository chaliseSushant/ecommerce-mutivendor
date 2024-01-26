<?php

namespace App\Http\Controllers\Dashboard;

use App\District;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();
        return view('dashboard.pages.districts')->with(['districts'=>$districts,'name'=>'District Management']);
    }

    public function store(Request $request)
    {
        
        $district = isset($request->id)?District::findOrFail($request->id):new District();
        $district->name = $request->name;
        $district->cod_enabled = isset($request->cod_enabled)?1:0;
        $district->is_enabled_vendor = isset($request->is_enabled_vendor)?1:0;
        $district->province_id = $request->province_id;
        if(isset($request->is_enabled))
        {
            $province = Province::find($district->province_id);
            $province->is_enabled = 1;
            $province->save();

            $district->is_enabled = 1;
        }
        elseif(!isset($request->is_enabled))
        {
            $enabled_districts = District::where('province_id',$request->province_id)->where('is_enabled',1)->get();
            if($enabled_districts->count() ==1 && $enabled_districts[0]->id = $request->id)
            {
                $province = Province::find($district->province_id);
                $province->is_enabled = 0;
                $province->save();
            }
             $district->is_enabled = 0;
        }

        $district->save();
        return redirect()->back();

    }

    public function destroy($id)
    {
        District::findOrFail($id)->delete();
        return redirect('dashboard/address/district');
    }
}
