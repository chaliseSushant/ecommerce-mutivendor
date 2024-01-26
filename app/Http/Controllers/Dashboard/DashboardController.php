<?php

namespace App\Http\Controllers\Dashboard;


use App\Brand;
use App\CartItem;
use App\Category;
use App\Container;
use App\Http\Controllers\Controller;
use App\Notifications\SystemNotifier;
use App\Product;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use stdClass;


class DashboardController extends Controller
{
    public function test()
    {
     //   dd(Storage::disk());

        /*$containers = Container::all();
        dd($containers[3]->data());*/
        /*$product = Product::find(4);
        $product->categories()->sync([]);
        return response('message sent',200);*/

        /*$users = Role::where('role','admin')->first()->users;
            $data = [
                'target_url' => '/testurl',
                'message' => 'This is a test message sent to the user.'
            ];
        Notification::send($users, new SystemNotifier($data));

        return response('message sent',200);*/
        dd(Auth::user()->discount(20));
    }
    public function index()
    {
        if (Auth::check())
        {
            if(Auth::user()->hasRole('admin'))
            {
                return $this->adminAnalytics();
            }
            elseif (Auth::user()->hasRole('vendor'))
            {
                return $this->storeAnalytics();
            }
            elseif (Auth::user()->hasRole('employee'))
            {
                return $this->storeAnalytics();
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    public function adminAnalytics()
    {
        return view('dashboard.pages.index')->with('name','eCommerce');
    }
    public function storeIndex()
    {
        return view('dashboard.pages.vendor_index')->with('name','Store eCommerce');
    }
    public function storeAnalytics()
    {
        return view('dashboard.pages.vendor_analytics')->with('name','Store Analytics');
    }
}
