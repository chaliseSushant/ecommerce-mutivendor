<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\ConfirmationMessage;
use App\Http\Controllers\Controller;
use App\SpecificationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $parent_categories = Category::where('parent_id',0)->get();
        return view('dashboard.pages.categories')->with(['categories'=>$categories,'parent_categories'=>$parent_categories,'name'=>'Categories']);
    }


    public function store(Request $request)
    {
        $category = isset($request->id)?Category::findOrFail($request->id):new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        if((isset($request->id) && $category->hasChild()) || $request->parent_id == '0')
            $category->commission = 0;
        else
            $category->commission = $request->commission;
        if($category->save())
            $message = isset($request->id)?['message'=>ConfirmationMessage::$updateCategorySuccessMessage,'type'=>'update']:['message'=>ConfirmationMessage::$saveCategorySuccessMessage,'type'=>'save'];
        else
            $message = ['message'=>ConfirmationMessage::$errorCategorySuccessMessage];
        return redirect('/dashboard/categories')->with('messages',$message);
    }

    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
        if(isset($category)) {
            if($category->delete())
                $message = ['message'=>ConfirmationMessage::$deleteCategorySuccessMessage,'type'=>'delete'];

        }

        return redirect('/dashboard/categories')->with('messages',$message);
    }
}
