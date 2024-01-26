<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_menus = Menu::where('parent_id',0)->orderBy('order')->get();
        $child_menus = Menu::all();
        return view('dashboard.pages.menu')->with(['child_menus'=>$child_menus,'parent_menus'=>$parent_menus,'name'=>'Menu']);

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

        $menu = isset($request->id)?Menu::findOrFail($request->id):new Menu();
        $menu->name = $request->name;
        $menu->parent_id = $request->parent;
        $menu->order = $request->order;
        $menu->url = isset($request->url)?$request->url:"#";
        if(!isset($request->id))
        {

            if($request->type == "product")
                $menu->url = url('/')."/"."product/".$request->type_id;
            elseif($request->type == "category")
                $menu->url = url('/')."/"."category/".$request->type_id;
            elseif($request->type == "brand")
                $menu->url = url('/')."/"."brand/".$request->type_id;
            elseif($request->type == "none")
                $menu->url = $request->url;

        }

        $menu->save();
        return redirect('/dashboard/menus');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_id)
    {
        if(Menu::findOrFail($menu_id)->hasChild())
        {
            $ids = Menu::where('parent_id',$menu_id)->pluck('id');

            $deleted_num = Menu::whereIn('id',$ids)->delete();

        }
        Menu::findOrFail($menu_id)->delete();
        return redirect('dashboard/menus');

    }
}
