<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\ConfirmationMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.pages.brands')->with(['brands'=>$brands,'name'=>'Brands']);
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
        $brand = isset($request->id)?Brand::findOrFail($request->id):new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        if($request->hasFile('icon'))
        {
            if(isset($request->id) && $brand->icon !=null)
            {
                $path = str_replace('/storage/', "app/public/", $brand->icon);

                unlink(storage_path($path));
            }

            $imageName = 'brand_'.$brand->name.".".$request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->move(storage_path('app/public/images/brands/'),$imageName);
            $brand->icon = Storage::url('/images/brands/'.$imageName);
        }
        if($brand->save())
            $message = isset($request->id)?['message'=>ConfirmationMessage::$updateBrandSuccessMessage,'type'=>'update']:['message'=>ConfirmationMessage::$saveBrandSuccessMessage,'type'=>'save'];
        else
            $message = ['message'=>ConfirmationMessage::$errorBrandSuccessMessage];
        return redirect('/dashboard/brands')->with('messages',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }


    public function destroy($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);

        if(isset($brand)) {
            if(File::exists($brand->icon)) {
                File::delete($brand->icon);
            }
            if($brand->delete())
                $message = ['message'=>ConfirmationMessage::$deleteBrandSuccessMessage,'type'=>'delete'];
        }

        return redirect('/dashboard/brands')->with('messages',$message);
    }
}
