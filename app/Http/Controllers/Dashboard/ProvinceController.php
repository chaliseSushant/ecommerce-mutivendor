<?php

namespace App\Http\Controllers\Dashboard;

use App\District;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $provinces = Province::all();
        return view('dashboard.pages.provinces')->with(['provinces'=>$provinces,'name'=>'Province Management']);
    }

   
    public function store(Request $request)
    {
        $province = isset($request->id)?Province::findOrFail($request->id):new Province();
        $province->name = $request->name;
        if(!isset($request->id))
            $province->code = Province::max('code')+1;
        if(isset($request->is_enabled))
            $province->is_enabled =1;
        elseif(!isset($request->is_enabled))
        {
            $province->is_enabled = 0;
            if(isset($request->id))
            {
                $districts = District::where('province_id',$request->id)->update(['is_enabled'=>0]);
            }
        }
        $province->save();

        return redirect()->back();
    }

    
    
    public function destroy($id)
    {
        District::where('province_id',$id)->delete();
        Province::findOrFail($id)->delete();
        return redirect('dashboard/address/province');
        
    }
}
