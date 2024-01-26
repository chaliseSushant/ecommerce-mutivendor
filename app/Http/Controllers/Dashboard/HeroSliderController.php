<?php

namespace App\Http\Controllers\Dashboard;

use App\HeroSlider;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class HeroSliderController extends Controller
{

    public function index()
    {
        return view('dashboard.pages.hero_slider')->with('name','Hero Slider');
    }

    public function uploadedImages()
    {

        $hero_sliders = HeroSlider::all();

        return response()->json(['uploads' => $hero_sliders]);
    }


    public function upload_files(Request $request)
    {



        if ($request->hasFile('file')) {

            $file = $request->file('file');

            // print_r($file);

            $folder = storage_path('app/public/images/hero_slider/');
            $filename = "hero_slider_".time().".".$file->getClientOriginalExtension();
            $date_append = date("Y-m-d-His-");
            $hero_slider_success = $file->move($folder,$filename);

            if ($hero_slider_success) {

                // Get public preferences


                $hero_slider = new HeroSlider();
                $hero_slider->url = "#";
                $hero_slider->image_url = Storage::url('images/hero_slider/'.$filename);
                $hero_slider->active = 1;
                $hero_slider->extension =$file->getClientOriginalExtension() ;
               /* $hero_slider = HeroSlider::create([
                    "store_id" => $store_id,
                    "url" => "#",
                    "image_url" => 'images/'.$store_id."/hero_slider/".$filename,
                    "active" => 1,
                ]);*/
                // apply unique random hash to file

                $hero_slider->save();

                return response()->json([
                    "status" => "success",
                    "upload" => $hero_slider
                ], 200);
            } else {
                return response()->json([
                    "status" => "error"
                ], 400);
            }
        } else {
            return response()->json('error: upload file not found.', 400);
        }


    }


    public function uploaded_files()
    {
        $hero_sliders = Auth::user()->store->heros;

        return response()->json(['uploads' => $hero_sliders]);

    }


    public function update(Request $request)
    {

        $hero_slider = HeroSlider::find($request->id);
        if(isset($hero_slider->id)) {

                // Update
            if($request->is_active == "on")
                $hero_slider->active = 1;

            $hero_slider->url = $request->url;
            $hero_slider->save();

                return response()->json([
                    'status' => "success"
                ]);



        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Upload not found"
            ]);
        }

    }

    public function delete_file(Request $request)
    {

        $file_id = $request->id;

        $hero_slider = HeroSlider::find($file_id);
        if(isset($hero_slider->id)) {


                // Update Caption
                $path = str_replace('/storage/',"app/public/",$hero_slider->image_url);
            //dd($path);
                unlink(storage_path($path));
                $hero_slider->delete();

                return response()->json([
                    'status' => "success"
                ]);


        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Upload not found"
            ]);
        }
    }

}
