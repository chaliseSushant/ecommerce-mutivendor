<?php

namespace App\Providers;

use App\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        View::composer(['frontend.layouts.nav'],function ($view)
        {
            $menus = Cache::remember('menus', 22*60, function() {
                return Menu::orderBy('order')->where('parent_id', '=', 0)->get();
            });
            $allMenus = Cache::remember('allMenus', 22*60, function() {
                return Menu::orderBy('order')->pluck('name','id');
            });
            $view->with('menus',$menus)
                ->with('allMenus',$allMenus);
        });
    }
}
