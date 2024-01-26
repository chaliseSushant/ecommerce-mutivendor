<?php

namespace App\Http\Controllers\Pub;

use App\Area;
use App\Brand;
use App\Cart;
use App\CartItem;
use App\Category;
use App\Container;
use App\Courier;
use App\CustomerAddress;
use App\HeroSlider;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\OrderStatus;
use App\Page;
use App\Product;
use App\Review;
use App\Store;
use App\Vendor;
use function GuzzleHttp\Psr7\mimetype_from_extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use function Sodium\crypto_aead_aes256gcm_decrypt;

class PageController extends Controller
{
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return redirect()->back();
    }
    public function index()
    {
        $slides = Cache::remember('slides', 22*60, function() {
            return HeroSlider::orderByDesc('id')->take(6)->get();
        });
        $containers = Container::all();
        return view('frontend.pages.index')
            ->with('containers',$containers->sortBy('order'))
            ->with('slides',$slides)
            ->with('type','home');
    }
    public function page($slug)
    {
        $page = Page::where('slug',$slug)->first();
        if ($page !=null)
        {
            return view('frontend.pages.page')
                ->with('page',$page)
                ->with('type','page');
        }
        else
        {
            abort(404);
        }
    }
    public function category($id)
    {
        $category = Category::find($id);

        if ($category != null)
        {
            $products = $category->listProducts();
            return view('frontend.pages.category')
                ->with('products',$products)
                ->with('category', $category)
                ->with('type','category');
        }
        else
        {
            abort(404);
        }
    }
    public function vendor($id)
    {
        $vendor = Vendor::find($id);
        if ($vendor != null)
        {
            $products = $vendor->listProducts();
            return view('frontend.pages.vendor')
                ->with('vendor', $vendor)
                ->with('products',$products)
                ->with('type','vendor');
        }
        else
        {
            abort(404);
        }
    }
    public function product($id)
    {
        $product = Product::find($id);
        if ($product != null)
        {
            return view('frontend.pages.product')
                ->with('product',$product)
                ->with('type','product');
        }
        else
        {
            abort(404);
        }
    }
    public function brand($id)
    {
        $brand = Brand::find($id);
        if ($brand != null)
        {
            $products = $brand->listProducts();
            return view('frontend.pages.brand')
                ->with('brand',$brand)
                ->with('products',$products)
                ->with('type','brand');
        }
        else
        {
            abort(404);
        }
    }

    public function cancelOrder($order_id)
    {
        $order = Order::find($order_id);
        if (isset($order))
        {
            if ($order->user_id == Auth::id())
            {
                $order->order_status_id = OrderStatus::where('name','Cancelled')->first()->id;
                $order->save();
                return redirect('customer/orders');
            }
            else
            {
                return response('Order can not be cancelled. User Mismatch.',401);
            }
        }
        else
        {
            return response('Order can not be cancelled. Order can not be found.',404);
        }
    }
    public function updateAddressAtCheckout(Request $request, $cart_id)
    {
        $cart = Cart::where('id',$cart_id)->where('user_id', Auth::id())->first();
        if ($cart == null)
        {
            return redirect()->back();
        }
        else
        {
            $c_address = new CustomerAddress();
            $c_address->name = $request->name;
            $c_address->phone = $request->phone;
            $c_address->district_id = $request->district;
            $c_address->address_01 = $request->line1;
            $c_address->address_02 = $request->line2;
            $c_address->customer_id = Auth::user()->customer->id;
            if (isset($request->is_default))
            {

                $c_address->default = 1;
                $customer_add = CustomerAddress::where('customer_id',Auth::user()->customer->id)->get();
                foreach ($customer_add as $address)
                {
                    $address->default = 0;
                    $address->save();
                }
            }
            else
            {
                $c_address->default = 0;
            }
            $c_address->save();
            return redirect()->back();
        }

    }

    public function calculateShipping($value,$cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $sub_total = $cart->subTotal();
        if($value == "pickup")
        {

            if($cart->store->minimumFreeCourier()['status'])
            {
                $minimum_cost = $cart->store->minimumFreeCourier()['value'];
                if($sub_total<$minimum_cost){
                    return response()->json(['shipping_charge'=>$cart->store->setting->courier_charge]);
                }
                elseif ($sub_total>=$minimum_cost)
                {
                    return response()->json(['shipping_charge'=>0]);
                }
            }
        }
        if($value == "home")
        {

            if($cart->store->minimumFreeHomeDelivery()['status'])
            {
                $minimum_cost = $cart->store->minimumFreeHomeDelivery()['value'];
                if($sub_total<$minimum_cost){
                    return response()->json(['shipping_charge'=>$cart->store->setting->home_delivery_charge]);
                }
                elseif ($sub_total>=$minimum_cost)
                {
                    return response()->json(['shipping_charge'=>0]);
                }
            }
        }

    }

    public function getCourier($id)
    {
        $courier = Courier::findOrFail($id);
        return response()->json(['description'=>$courier->description]);
    }
    public function notificationRedirect($id)
    {
        $notification = Notification::where('id',$id)->first();
        if ($notification != null)
        {
            $data = json_decode($notification->data);
            return redirect(url($data->data->target_url));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function saveUpdateReview(Request $request)
    {

        $review = isset($request->id)?Review::findOrFail($request->id):new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        if(!isset($request->id))
        {
            $review->customer_id = Auth::user()->customer->id;
            $review->product_id = $request->product_id;
        }



        $review->save();
        return redirect()->back();
    }

    public function  deleteReview($id)
    {
        $review = Review::findOrFail($id);
        if(isset($review))
        {
            $review->delete();
        }
        return redirect()->back();

    }


}
