<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_provinces','API\BaseController@getProvinces');
Route::get('get_districts/{province_id}','API\BaseController@getDistricts');
Route::get('get_vendor_districts/{province_id}','API\BaseController@getVendorDistricts');
