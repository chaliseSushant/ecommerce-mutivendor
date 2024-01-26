<?php

namespace App\Http\Controllers\Dashboard;

use App\ConfirmationMessage;
use App\Http\Controllers\Controller;
use App\Product;
use App\Specification;
use App\SpecificationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecificationValueController extends Controller
{

    public function index($id)
    {

        $specification_values = SpecificationValue::where('product_id',$id)->get();
/*        $specification_values = $specification_values->isEmpty()? new SpecificationValue():$specification_values;*/
        $specification_titles = Product::find($id)->categories->first()->specifications;




        return view('dashboard.pages.product_specification')->with(['specification_values'=>$specification_values,'specification_titles'=>$specification_titles,'product_id'=>$id,'name'=>'Product Specification']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $request->validate([
        'value'=>'required',
        'specification_id'=>'required'
        ]);
        $product_specification = isset($request->id)?SpecificationValue::findOrFail($request->id):new SpecificationValue();
        $product_specification->product_id = $request->product_id;
        $product_specification->value = $request->value;
        $product_specification->specification_id = $request->specification_id;
        $product_specification->save();
        if($product_specification->save())
            $message = isset($request->id)?['message'=>ConfirmationMessage::$updateProductSpecificationSuccessMessage,'type'=>'update']:['message'=>ConfirmationMessage::$saveProductSpecificationSuccessMessage,'type'=>'save'];
        else
            $message = ['message'=>ConfirmationMessage::$errorProductSpecificationSuccessMessage];


        return redirect()->back()->with('messages',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpecificationValue  $specificationValue
     * @return \Illuminate\Http\Response
     */
    public function show(SpecificationValue $specificationValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpecificationValue  $specificationValue
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecificationValue $specificationValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpecificationValue  $specificationValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecificationValue $specificationValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpecificationValue  $specificationValue
     * @return \Illuminate\Http\Response
     */
    public function destroy($value_id)
    {

        $product_specification = SpecificationValue::findOrFail($value_id);
        if(isset($product_specification)) {
            if($product_specification->delete())
                $message = ['message'=>ConfirmationMessage::$deleteProductSpecificationSuccessMessage,'type'=>'delete'];

        }

        return redirect()->back()->with('messages',$message);
    }
}
