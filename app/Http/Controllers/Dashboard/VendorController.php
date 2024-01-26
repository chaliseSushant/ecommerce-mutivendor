<?php

namespace App\Http\Controllers\Dashboard;

use App\ConfirmationMessage;
use App\Http\Controllers\Controller;
use App\Image;
use App\Outlet;
use App\Product;
use App\Vendor;
use App\VendorDocument;
use App\VendorSetting;
use App\VendorType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public static $vendor_id = 0;

    public function index()
    {

        $vendors = Vendor::whereNotNull('approved_at')->get();
        return view('dashboard.pages.vendor-index')->with(['vendors' => $vendors, 'name' => 'Vendors']);
    }


    public function showProducts($id)
    {
        $products = Product::where('vendor_id', $id)->get();
        $vendor = Vendor::where('id', $id)->first();


        return view('dashboard.pages.products')->with(['products' => $products, 'name' => 'Products', 'vendor' => $vendor]);
    }

    public function store(Request $request)
    {
        $vendor = isset($request->id) ? Vendor::findOrFail($request->id) : new Vendor();
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->alt_phone = $request->alt_phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->vendor_type_id = $request->vendor_type;
        if ($request->hasFile('cover')) {
            request()->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = 'cover-' . strtolower(implode('_',explode(' ',$vendor->name))) . '.' . $request->cover->getClientOriginalExtension();
            $request->cover->move(storage_path('app/public/images/vendors/covers'), $imageName);
            $vendor->cover = Storage::url('images/vendors/covers/' . $imageName);
        }
        if ($request->hasFile('icon')) {
            request()->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = 'icon-' . strtolower(implode('_',explode(' ',$vendor->name))) . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->move(storage_path('app/public/images/vendors/icons'), $imageName);
            $vendor->icon = Storage::url('images/vendors/icons/' . $imageName);
        }
        if ($vendor->save())
            $message = isset($request->id) ? ['message' => ConfirmationMessage::$updateVendorSuccessMessage, 'type' => 'update'] : ['message' => ConfirmationMessage::$saveVendorSuccessMessage, 'type' => 'save'];
        else
            $message = ['message' => ConfirmationMessage::$errorVendorSuccessMessage];
        return redirect()->back()->with('messages', $message);
    }

    public function saveBankDetails(Request $request)
    {

        $vendor_id = Auth::user()->vendor->id;
        $bank_details = VendorSetting::findOrFail($vendor_id);
        $bank_details->account_name = $request->account_name;
        $bank_details->account_number = $request->account_number;
        $bank_details->bank_name = $request->bank_name;
        $bank_details->branch = $request->branch;

        if($bank_details->save());
            $message = ['message' => ConfirmationMessage::$updateBankDetailsSuccessMessage, 'type' => 'update'];

        return redirect()->back()->with('messages', $message);

    }

    public function vendorSettings()
    {

        $vendor_id = Auth::user()->vendor->id;
        $vendor_info = Vendor::findOrFail($vendor_id);
        $bank_details = VendorSetting::where('vendor_id',$vendor_id)->first();
        return view('dashboard.pages.vendor-general-settings')->with(['name'=>'Vendor General Settings','vendor_info'=>$vendor_info,'bank_details'=>$bank_details]);
    }

    public function uploadImages(Request $request)
    {

        $vendor_id = Auth::user()->hasPrivilege('add/edit/delete-vendors-docs')?$request->vendor_id:Auth::user()->vendor->id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $folder = storage_path('app/public/images/vendors/'. $vendor_id .'/'.'docs' );
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $date_append = date("Y-m-d-His-");
            $vendor_image_success = $file->move($folder, $filename);

            if ($vendor_image_success) {

                $vendor_image = new VendorDocument();
                $vendor_image->vendor_id = $request->vendor_id;
                $vendor_image->url = Storage::url('images/vendors/'. $vendor_id .'/'.'docs/'. $filename);

                $vendor_image->save();

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

    public function getOutlets($vendor_id)
    {
        $outlets = Outlet::where('vendor_id',$vendor_id)->get();
        return $outlets;
    }

    public function outlets($vendor_id = null)
    {
        $id = isset($vendor_id)?$vendor_id:Auth::user()->vendor->id;

        $outlets = $this->getOutlets($id);
        return view('dashboard.pages.outlets')->with(['outlets'=>$outlets,'vendor_id'=>$id,'name'=>'Outlets']);

    }

    public function saveOutlets(Request $request)
    {
        $outlet = isset($request->id)?Outlet::findOrFail($request->id):new Outlet();
        $outlet->name = $request->name;
        $outlet->address_01 = $request->address_01;
        $outlet->address_02 = $request->address_02;
        $outlet->district_id = $request->district_id;
        $outlet->vendor_id = $request->vendor_id;
        $outlet->save();

        return redirect('dashboard/vendor/outlets/'.$outlet->vendor_id);
    }

    public function deleteOutlet($outlet_id)
    {
        $outlet = Outlet::findOrFail($outlet_id);
        $outlet->delete();
        return redirect('dashboard/vendor/outlets/'.$outlet->vendor_id);
    }


    public function uploadedImages($vendor_id)
    {

        $vendor_images = VendorDocument::where('vendor_id', $vendor_id)->get();

        return response()->json(['uploads' => $vendor_images]);
    }

    public function deleteVendorImage($id)
    {
        $vendor_image = VendorDocument::where('id', $id)->first();

        if (isset($vendor_image)) {
            $path = str_replace('/storage/', "app/public/", $vendor_image->url);
            //dd($path);
            unlink(storage_path($path));
            if ($vendor_image->delete())
                return response()->json(['message' => 'Successfully deleted Image']);
        }
    }

    public function changeStatus($id, $status)
    {
        $status = (int)$status;
        $id = (int)$id;
        $vendor = Vendor::findOrFail($id);

        $vendor->status = $status;
        if ($vendor->save())
            return response()->json(['message' => "Successfully Updated Vendor Status", 'type' => 'update']);
        else
            return response()->json(['message' => "Cannot update Vendor Status", 'type' => 'error']);
    }

    public function changeCertifiedStatus($id, $status)
    {
        $status = (int)$status;
        $id = (int)$id;
        $vendor = Vendor::findOrFail($id);

        $vendor->certified = $status;
        if ($vendor->save())
            return response()->json(['message' => "Successfully Updated Vendor Certified Status", 'type' => 'update']);
        else
            return response()->json(['message' => "Cannot update Vendor Certified Status", 'type' => 'error']);
    }

    public function approveVendor($id)
    {
        $id = (int)$id;
        $vendor = Vendor::findOrFail($id);

        $vendor->approved_at = Carbon::now();
        if ($vendor->save())
            return response()->json(['message' => "Successfully Approved Vendor", 'type' => 'update']);
        else
            return response()->json(['message' => "Cannot Approve Vendor", 'type' => 'error']);
    }

    public function create($id = null)
    {
        $vendor = isset($id) ? Vendor::findOrFail($id) : new Vendor();
        $vendor_types = VendorType::all();
        return view('dashboard.pages.modals.vendor_add_edit')->with(['vendors' => $vendor, 'vendor_types' => $vendor_types, 'name' => 'Add/Edit Vendor']);
    }

    public function showVendorRequest()
    {
        $vendors = Vendor::whereNull('approved_at')->get();
        return view('dashboard.pages.vendor-request')->with(['vendors'=>$vendors,'name'=>'Vendor Requests']);
    }

    public function destroy($vendor_id)
    {
        $vendor = Vendor::findOrFail($vendor_id);
        if (isset($vendor)) {
            DB::table('products')->where('vendor_id',$vendor_id)->update(['status'=>0]);
            if ($vendor->delete())
                $message = ['message' => ConfirmationMessage::$deleteVendorSuccessMessage, 'type' => 'delete'];
        }

        return redirect('/dashboard/vendors')->with('messages', $message);
    }
}
