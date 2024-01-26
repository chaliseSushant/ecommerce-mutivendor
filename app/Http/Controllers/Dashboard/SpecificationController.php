<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($specs = [])
    {
        $specifications = Specification::all();
       
        return view('dashboard.pages.specifications')->with(['specifications'=>$specifications,'name'=>'Product Specifications','specs'=>$specs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
     
        $spec_category = Specification::findOrFail($id)->categories->pluck('id');
        $spec_title = Specification::findOrfail($id);
      
        $sepcs = ['spec_categories'=>$spec_category,'spec_title'=>$spec_title];
        return $this->index($sepcs);
    }

   
    public function store(Request $request)
    {
        
        $specification = isset($request->id)?Specification::findOrFail($request->id):new Specification();
        $specification->name = $request->specification_title;
        $specification->save();
        if (isset($request->categories)) {
            $specification->categories()->sync($request->categories);
        }
        return redirect('/dashboard/product-specifications');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function edit(Specification $specification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specification $specification)
    {
        //
    }


    public function destroy($specification_id)
    {
        $specification = Specification::findOrFail($specification_id);
        if(isset($specification))
        {
            $specification->categories()->sync([]);
            $specification->delete();

        }


        return redirect('/dashboard/product-specifications');
    }
}
