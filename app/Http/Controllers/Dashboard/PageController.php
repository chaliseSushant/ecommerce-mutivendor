<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();

        return view('dashboard.pages.page')->with(['name'=>'Page Manager','pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $page = isset($id)?Page::findOrFail($id):new Page();

        return view('dashboard.pages.modals.pages_add_edit')->with(['name'=>'Page','page'=>$page]);
    }

    public function store(Request $request)
    {
        $page = isset($request->id)?Page::findOrFail($request->id):new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->meta_description = $request->meta_description;
        $page->description = $request->description;

        $page->save();
        return redirect('/dashboard/pages');
    }
}
