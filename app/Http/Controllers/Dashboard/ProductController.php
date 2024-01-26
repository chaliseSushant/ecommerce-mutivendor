<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\Category;
use App\ConfirmationMessage;
use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use App\Tag;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Auth::user()->vendor->products;

        return view('dashboard.pages.products')->with(['products' => $products, 'name' => 'Products']);
    }

    public function createProduct($vendor_id)
    {

        $products  = new Product();

        $productCategory = DB::select(DB::raw("select GROUP_CONCAT(category_id) as category_id from category_product where product_id = '$products->id'"));
        $productTags = DB::select(DB::raw("select GROUP_CONCAT(tag_id) as tag_id from product_tag where product_id = '$products->id'"));
        $productOutlets = DB::select(DB::raw("select GROUP_CONCAT(outlet_id) as outlet_id from outlet_product where product_id = '$products->id'"));
        $productCategory = explode(',', $productCategory[0]->category_id);
        $productTags = explode(',', $productTags[0]->tag_id);
        $productOutlets = explode(',', $productOutlets[0]->outlet_id);

        $brands = Brand::all('id', 'name');
        $categories = Category::where('parent_id', 0)->get();
        $tags = Tag::all('id', 'keyword');

        return view('dashboard.pages.modals.product_add_edit')->with(['products' => $products, 'brands' => $brands, 'categories' => $categories, 'tags' => $tags, 'productCategory' => $productCategory, 'productTag' => $productTags,'productOutlet' => $productOutlets,'vendor_id'=>$vendor_id,'name' => 'Add/Edit Product']);
    }
    public function create($id = null)
    {
        $products  = isset($id) ? Product::findOrFail($id) : new Product();

        $productCategory = DB::select(DB::raw("select GROUP_CONCAT(category_id) as category_id from category_product where product_id = '$id'"));
        $productTags = DB::select(DB::raw("select GROUP_CONCAT(tag_id) as tag_id from product_tag where product_id = '$id'"));
        $productOutlets = DB::select(DB::raw("select GROUP_CONCAT(outlet_id) as outlet_id from outlet_product where product_id = '$id'"));
        $productCategory = explode(',', $productCategory[0]->category_id);
        $productTags = explode(',', $productTags[0]->tag_id);
        $productOutlets = explode(',', $productOutlets[0]->outlet_id);

        $brands = Brand::all('id', 'name');
        $categories = Category::where('parent_id', 0)->get();
        $tags = Tag::all('id', 'keyword');

        return view('dashboard.pages.modals.product_add_edit')->with(['products' => $products, 'brands' => $brands, 'categories' => $categories, 'tags' => $tags, 'productCategory' => $productCategory, 'productTag' => $productTags,'productOutlet' => $productOutlets,'name' => 'Add/Edit Product']);
    }

    public function showProductDetails($id)
    {
        $product_detail = Product::findOrFail($id);
        return view('');
    }

    public function uploadedImages($product_id)
    {

        $product_images = Image::where('product_id', $product_id)->get();

        return response()->json(['uploads' => $product_images]);
    }
    public function store(Request $request)
    {


        $product = isset($request->id) ? Product::findOrFail($request->id) : new Product();
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->display_price = $request->display_price;
        $product->brand_id = $request->brand_id;
        $product->stock = isset($request->stock)?1:0;
        $product->value = $request->value;
        $product->vendor_id = isset($request->vendor_id) ? $request->vendor_id : Auth::user()->vendor->id;
        $product->description = $request->description;
        $product->instant_delivery = isset($request->instant_delivery)?1:0;
        if(isset($request->instant_delivery))
        {
            $request->validate([
                'shipping_instant_base'=>'required',
                'shipping_instant_additional'=>'required'
            ]);

        }
        $product->shipping_instant_base = $request->shipping_instant_base;
        $product->shipping_instant_additional = $request->shipping_instant_additional;
        if(isset($request->national_delivery))
        {
            $request->validate([
                'shipping_national_base'=>'required',
                'shipping_national_additional'=>'required'
            ]);
        }
        $product->shipping_national_base = $request->shipping_national_base;
        $product->shipping_national_additional = $request->shipping_national_additional;
        $product->national_delivery = isset($request->national_delivery)?1:0;
        $product->shipping_local_base = $request->shipping_local_base;
        $product->shipping_local_additional = $request->shipping_local_additional;
        $product->shipping_national_base = $request->shipping_national_base;
        $product->shipping_national_additional = $request->shipping_national_additional;

        if ($request->hasFile('thumbnail')) {
            $request->validate([
                'thumbnail'=>'required|image|mimes:jpeg,png,jpg'
            ]);
             if(isset($request->id) && $product->thumbnail != null)
            {
                $path = str_replace('/storage/', "app/public/", $product->thumbnail);
                unlink(storage_path($path));
            }

            $imageName = "thumb_".uniqid() . '.' . $request->thumbnail->getClientOriginalExtension();
            $temp_path = storage_path('app/public/images/vendors/' . $product->vendor_id . '/products');
            if (!Storage::disk('public')->has('images/vendors/' . $product->vendor_id . '/products'))
            {
                Storage::disk('public')->makeDirectory('images/vendors/' . $product->vendor_id . '/products');
            }
            $img = InterventionImage::make($request->thumbnail->getRealPath())->orientate()->interlace()->encode('jpg', 66.7);
            $img->resize(400,null, function ($const) {
                $const->aspectRatio();
            })->crop(400,400,0,0)->save($temp_path.'/'.$imageName);
               // $img->resizeCanvas(400,225,'top',false)->save($temp_path.'/'.$imageName);
            //$request->thumbnail->move(storage_path('app/public/images/vendors/' . $product->vendor_id . '/products'), $imageName);
            $product->thumbnail = Storage::url('images/vendors/' . $product->vendor_id . '/products/' . $imageName);
        }
        $product->save();

        if (isset($request->category)) {
            $product->categories()->sync($request->category);
        }
        if (isset($request->outlet)) {
            $product->outlets()->sync($request->outlet);
        }
        if (isset($request->tag)) {
            $product->tags()->sync($request->tag);
        }
        $message = isset($request->id) ? ['message' => ConfirmationMessage::$updateProductSuccessMessage, 'type' => 'update'] : ['message' => ConfirmationMessage::$saveProductSuccessMessage, 'type' => 'save'];

        return redirect('/dashboard/vendor/products/'.$product->vendor_id)->with('messages', $message);
    }


    public function changeStatus($id, $status)
    {
        $status = (int)$status;
        $id = (int)$id;
        $product = Product::findOrFail($id);

        $product->status = $status;
        if ($product->save())
            return response()->json(['message' => "Successfully updated Product Status", 'type' => 'update']);
        else
            return response()->json(['message' => "Cannot update Product Status", 'type' => 'error']);
    }

    public function uploadImages(Request $request)
    {

        $vendor_id = $request->vendor_id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $folder = storage_path('app/public/images/vendors/' . $vendor_id . "/products");
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            if (!Storage::disk('public')->has('images/vendors/' .$vendor_id . '/products'))
            {
                Storage::disk('public')->makeDirectory('images/vendors/' . $vendor_id . '/products');
            }
            $img = InterventionImage::make($request->file->getRealPath())->orientate()->interlace()->encode('jpg', 66.7);
            $product_image_success = $img->resize(1036,null, function ($const) {
                $const->aspectRatio();
            })->crop(1036,741,0,0)->save($folder.'/'.$filename);
           // $product_image_success = $file->move($folder, $filename);

            if ($product_image_success) {

                // Get public preferences
                $product_image = new Image();
                $product_image->product_id = $request->product_id;
                $product_image->url = Storage::url('images/vendors/' . $vendor_id . '/products/'. $filename);
                $product_image->extension = $file->getClientOriginalExtension();


                $product_image->save();

                return response()->json([
                    "status" => "success",
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

    public function deleteProductImage($id)
    {

        $product_image = Image::where('id', $id)->first();

        if (isset($product_image)) {
            $path = str_replace('/storage/', "app/public/", $product_image->url);

            unlink(storage_path($path));
            if ($product_image->delete())
                return response()->json(['message' => 'Successfully deleted Image']);
        }
    }


    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        if (isset($product)) {
            $images = Image::where('product_id', $product_id)->get();

            $product->categories()->sync([]);
            $product->tags()->sync([]);
            $product->outlets()->sync([]);
            if(isset($images))
            {
                foreach ($images as $image){
                    $path = str_replace('/storage/', "app/public/", $image->url);
                    unlink(storage_path($path));
                    $image->delete();
                }

            }
            if(isset($product->thumbnail))
            {
                $product_image_path = str_replace('/storage/', "app/public/", $product->thumbnail);
                unlink(storage_path($product_image_path));
            }

            $product->delete();
        }

        return redirect()->back();
    }
}
