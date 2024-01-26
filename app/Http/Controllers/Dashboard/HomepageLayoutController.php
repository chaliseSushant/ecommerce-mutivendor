<?php

namespace App\Http\Controllers\Dashboard;

use App\Card;
use App\ConfirmationMessage;
use App\Container;
use App\HomepageLayout;
use App\HomepageLayoutGroup;
use App\HomepageLayoutItem;
use App\Http\Controllers\Controller;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageLayoutController extends Controller
{

    public function index()
    {
        $templates = Template::all('id','name');
        $containers = Container::orderBy('order','ASC')->get();
        return view('dashboard.pages.homepage_layout')->with(['name'=>'Homepage Layout','templates'=>$templates,'containers'=>$containers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {

        foreach ($request->orders as $container_order)
        {
            $container = Container::findOrFail($container_order['id']);
            $container->order = $container_order['order'];
            $container->save();
        }
        return response()->json($container);
    }

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
        $container = isset($request->id)?Container::findOrFail($request->id):new Container();

        $container->order = Container::max('order')+1;
        $container->title = $request->title;
        $container->template_id = $request->template_id;
        if($request->type =="category" || $request->type == "brand")
        {
            $container->type = $request->type;
            $container->type_id = $request->type_id;
        }

        if($container->save())
            $message = isset($request->id)?['message'=>ConfirmationMessage::$updateHomepageLayoutItemSuccessMessage,'type'=>'update']:['message'=>ConfirmationMessage::$saveHomepageLayoutItemSuccessMessage,'type'=>'save'];
        else
            $message = ['message'=>ConfirmationMessage::$errorHomepageLayoutItemSuccessMessage];
        if($request->type == null)
        {
            $template_size = $container->template->size;
            for($i = 0;$i<$template_size;$i++)
            {
                $card = new Card();
                $card->order = $i;
                $card->container_id = $container->id;
                $card->save();
            }
        }


        return redirect()->back()->with('messages',$message);
    }

    public function updateCardItem(Request $request)
    {
        $card_item = Card::findOrFail($request->id);
        $card_item->type = $request->type;
        $card_item->type_id = $request->type_id;
        if($request->type !="banner")
        {
            $card_item->image = null;
            $card_item->url = null;
        }
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileName = "banner_".time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/images/banner/'), $fileName);
            $card_item->image = Storage::url('images/banner/'. $fileName);
            $card_item->url = $request->url;
        }
         $card_item->save();
         return redirect()->back();
    }

    public function show(HomepageLayout $homepageLayout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomepageLayout  $homepageLayout
     * @return \Illuminate\Http\Response
     */
    public function edit(HomepageLayout $homepageLayout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomepageLayout  $homepageLayout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomepageLayout $homepageLayout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomepageLayout  $homepageLayout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homePageLayout = Container::findOrFail($id);
        $cards = Card::where('container_id',$id)->get();
        if($cards->count()>0) {

            foreach ($cards as $card) {
                $card->delete();
            }
        }
        $homePageLayout->delete();
        return redirect('/dashboard/homepage_layout');
    }
}
