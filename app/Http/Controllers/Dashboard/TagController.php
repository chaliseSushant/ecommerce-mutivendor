<?php

namespace App\Http\Controllers\Dashboard;

use App\Tag;
use App\ConfirmationMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('dashboard.pages.tags')->with(['tags' => $tags, 'name' => 'Tags']);
    }


    public function store(Request $request)
    {

        $tag = isset($request->id) ? Tag::findOrFail($request->id) : new Tag();
        $tag->keyword = $request->keyword;

        if ($tag->save())
            $message = isset($request->id) ? ['message' => ConfirmationMessage::$updateTagSuccessMessage, 'type' => 'update'] : ['message' => ConfirmationMessage::$saveTagSuccessMessage, 'type' => 'save'];
        else
            $message = ['message' => ConfirmationMessage::$errorTagSuccessMessage];
        return redirect('/dashboard/tags')->with('messages', $message);
    }

    public function createNewTag(Request $request)
    {
        $tags = new Tag();
        $tags->keyword = $request->formData;

        $tags->save();

        return response()->json($tags);
    }

    public function getTag()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function destroy($tag_id)
    {
        $tag = Tag::findOrFail($tag_id);
        if (isset($tag)) {
            if ($tag->delete())
                $message = ['message' => ConfirmationMessage::$deleteTagSuccessMessage, 'type' => 'delete'];
        }

        return redirect('/dashboard/tags')->with('messages', $message);
    }
}
