<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/callback/{provider}', 'Auth\LoginController@handleProviderCallback');
Route::get('/redirect/notification/{id}', 'NotificationController@redirectAfterNotification');

Route::get('/clear', 'Pub\PageController@clearCache');
Route::get('/test', 'Dashboard\DashboardController@test');
Route::middleware('auth:web')->get('/test2', 'Pub\CustomerController@setNotificationCookie');
Route::middleware('auth:web')->get('/test3', 'Pub\CustomerController@getNotificationFromCookie');

//Sitemap
Route::get('sitemap.xml','SitemapController@index');
Route::get('product-sitemap.xml','SitemapController@products');
Route::get('category-sitemap.xml','SitemapController@categories');
Route::get('brand-sitemap.xml','SitemapController@brands');
Route::get('vendor-sitemap.xml','SitemapController@vendors');
Route::get('page-sitemap.xml','SitemapController@pages');

Route::get('notification/{id}', 'Pub\PageController@notificationRedirect');
Route::get('/dashboard/change-password', 'Dashboard\UserController@changePasswordIndex');
Route::post('/dashboard/change-password/vendor', 'Dashboard\UserController@changePassword');
Route::middleware('auth:web')->get('/logout', 'Auth\LoginController@logout');
Route::middleware('auth:web')->get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

//Review Routes
Route::middleware('auth:web')->post('product/review/saveUpdate', 'Pub\PageController@saveUpdateReview');
Route::middleware('auth:web')->get('product/review/delete/{id}', 'Pub\PageController@deleteReview');

/*JS ROUTES*/
Route::get('dashboard/privilege/add/{id}', 'Dashboard\PrivilegeController@addPrivilege'); //SEND VARIABLE NAMED identifier
Route::get('dashboard/privilege/remove/{id}', 'Dashboard\PrivilegeController@removePrivilege'); //SEND VARIABLE NAMED identifier
Route::post('dashboard/privilege/save', 'Dashboard\PrivilegeController@store');
Route::post('/order/checkout/payment/khalti/confirm/{order_id}', 'Pub\PaymentController@khaltiValidate');
Route::post('/order/checkout/payment/esewa/confirm/{order_id}', 'Pub\PaymentController@esewaValidate');

//Admin Order Routes
Route::get('/dashboard/orders','Dashboard\OrderController@index');
Route::get('/dashboard/orders/cart/{id}','Dashboard\CartController@index');
Route::get('/dashboard/order/cart_item/status/{type}/{cart_item_id}/{datetime?}','Dashboard\CartController@updateStatus');
Route::post('/dashboard/order/cart_item/change_status/','Dashboard\CartController@reUpdateStatus');



/*ADMIN PAGE ROUTES*/

//Vendor
Route::middleware('privilege:view-vendors')->get('/dashboard/vendors', 'Dashboard\VendorController@index')->name('vendors');
Route::middleware('privilege:add/edit/delete-vendors')->get('/dashboard/vendors/add_edit/{id?}', 'Dashboard\VendorController@create')->name('vendors-create');
Route::middleware('privilege:update-vendor-details')->post('/dashboard/vendor/saveUpdate', 'Dashboard\VendorController@store');
Route::middleware('privilege:update-vendor-details')->post('/dashboard/vendor/bank_details/update', 'Dashboard\VendorController@saveBankDetails');
Route::middleware('privilege:view-vendor-products')->get('/dashboard/vendor/products/{id?}', 'Dashboard\VendorController@showProducts');
Route::middleware('privilege:add/edit/delete-vendors')->get('/dashboard/vendor/delete/{id}', 'Dashboard\VendorController@destroy');
Route::middleware('privilege:change-vendor-status')->get('/dashboard/vendor/status/{id}/{status}', 'Dashboard\VendorController@changeStatus');
Route::middleware('privilege:approve-vendors')->get('dashboard/vendor/approve_vendor/{id}', 'Dashboard\VendorController@approveVendor');
Route::middleware('privilege:certify-vendors')->get('/dashboard/vendor/certified/{id}/{status}', 'Dashboard\VendorController@changeCertifiedStatus');
Route::middleware('privilege:view-vendor-requests')->get('/dashboard/vendor/requests/', 'Dashboard\VendorController@showVendorRequest');
Route::middleware('privilege:add/edit/delete-vendors-docs')->post('/dashboard/vendor/docs/upload_files', 'Dashboard\VendorController@uploadImages')->name('image-vendor');
Route::middleware('privilege:add/edit/delete-vendors-docs')->get('/dashboard/vendor/docs/uploaded_files/{vendor_id}', 'Dashboard\VendorController@uploadedImages')->name('image-vendor');
Route::middleware('privilege:add/edit/delete-vendors-docs')->get('/dashboard/vendor/docs/delete/{vendor_id}', 'Dashboard\VendorController@deleteVendorImage')->name('delete-vendor-image');
Route::middleware('privilege:view-vendor-general-setting')->get('/dashboard/vendor/general-settings','Dashboard\VendorController@vendorSettings');
Route::middleware('privilege:view-vendor-orders')->get('/dashboard/vendor/orders','Dashboard\VendorOrderController@index');

Route::middleware('privilege:view-requests')->get('/dashboard/requests', 'Dashboard\RoleController@index')->name('roles');
Route::middleware('privilege:view-feedbacks')->get('/dashboard/feedbacks', 'Dashboard\RoleController@index')->name('roles');
Route::middleware('privilege:view-feedbacks')->get('/dashboard/feedbacks', 'Dashboard\RoleController@index')->name('roles');
//Vendor Admin
Route::middleware('privilege:view-vendor-administrators')->get('/dashboard/vendor-administrators', 'Dashboard\UserController@vendorAdmin')->name('vendor_admin');
Route::middleware('privilege:view-vendor-administrators')->post('/dashboard/admin-user/saveUpdate', 'Dashboard\UserController@saveUpdateUser')->name('save-vendor_admin');

Route::middleware('privilege:view-customers')->get('/dashboard/customers', 'Dashboard\CustomerController@index')->name('roles');
Route::middleware('privilege:view-users')->get('/dashboard/users', 'Dashboard\UserController@index')->name('users');
//Role
Route::middleware('privilege:view-roles')->get('/dashboard/roles', 'Dashboard\RoleController@index')->name('roles');
Route::middleware('privilege:add/edit/delete-roles')->post('/dashboard/role/saveUpdate', 'Dashboard\RoleController@store')->name('save-roles');
Route::middleware('privilege:add/edit/delete-roles')->get('/dashboard/role/delete/{id}', 'Dashboard\RoleController@destroy')->name('delete-roles');
Route::middleware('privilege:view-privileges')->get('/dashboard/privileges', 'Dashboard\PrivilegeController@index')->name('roles');
Route::middleware('privilege:view-general-settings')->get('/dashboard/general-settings', 'Dashboard\SettingsController@index')->name('roles');
//Analytics
Route::middleware('privilege:view-analytics')->get('/dashboard/analytics', 'Dashboard\DashboardController@adminAnalytics')->name('admin-analytics');

//Category
Route::middleware('privilege:view-categories')->get('/dashboard/categories', 'Dashboard\CategoryController@index')->name('categories');
Route::middleware('privilege:add/edit/delete-categories')->post('/dashboard/category/saveUpdate', 'Dashboard\CategoryController@store')->name('categories');
Route::middleware('privilege:add/edit/delete-categories')->get('/dashboard/category/delete/{id}', 'Dashboard\CategoryController@destroy')->name('categories');

//Tag
Route::middleware('privilege:view-tags')->get('/dashboard/tags', 'Dashboard\TagController@index')->name('tags');
Route::middleware('privilege:view-tags')->get('/dashboard/tag/getTag', 'Dashboard\TagController@getTag')->name('tags');
Route::middleware('privilege:add/edit/delete-tags')->post('/dashboard/tag/saveUpdate', 'Dashboard\TagController@store')->name('tags');
Route::middleware('privilege:add/edit/delete-tags')->post('/dashboard/tag/create', 'Dashboard\TagController@createNewTag')->name('tags');
Route::middleware('privilege:add/edit/delete-tags')->get('/dashboard/tag/delete/{id}', 'Dashboard\TagController@destroy')->name('tags');

//Brands
Route::middleware('privilege:view-brands')->get('/dashboard/brands', 'Dashboard\BrandController@index')->name('vendor-brands');
Route::middleware('privilege:add/edit/delete-brands')->post('/dashboard/brand/saveUpdate', 'Dashboard\BrandController@store')->name('save-brands');
Route::middleware('privilege:add/edit/delete-brands')->get('/dashboard/brand/delete/{id}', 'Dashboard\BrandController@destroy')->name('delete-brands');

//Vendor Type
Route::middleware('privilege:view-vendor-types')->get('/dashboard/vendor-types', 'Dashboard\VendorTypeController@index')->name('vendor-vendor-types');
Route::middleware('privilege:add/edit/delete-vendor-type')->post('/dashboard/vendor-type/saveUpdate', 'Dashboard\VendorTypeController@store')->name('save-vendor-type');
Route::middleware('privilege:add/edit/delete-vendor-type')->get('/dashboard/vendor-type/delete/{id}', 'Dashboard\VendorTypeController@destroy')->name('delete-vendor-type');

//Pages
Route::middleware('privilege:view-page-manager')->get('/dashboard/pages', 'Dashboard\PageController@index')->name('pages');
Route::middleware('privilege:add/edit/delete-page')->get('/dashboard/page/create/{id?}', 'Dashboard\PageController@create')->name('page-create');
Route::middleware('privilege:add/edit/delete-page')->post('/dashboard/page/saveUpdate', 'Dashboard\PageController@store')->name('save-page');

//Outlets
Route::get('/dashboard/vendor/total-outlet/{id}', 'Dashboard\VendorController@getOutlets')->name('total-outlets');
Route::get('/dashboard/vendor/outlets/{id?}', 'Dashboard\VendorController@outlets')->name('outlet');
Route::get('/dashboard/vendor/outlet/delete/{id}', 'Dashboard\VendorController@deleteOutlet')->name('delete-outlet');
Route::post('/dashboard/vendor/outlet/saveUpdate', 'Dashboard\VendorController@saveOutlets')->name('save-outlets');


/*Vendor ADMIN PAGE ROUTES*/

//Products
Route::middleware('privilege:view-vendor-products')->get('/dashboard/vendor/my_products', 'Dashboard\ProductController@index')->name('vendor-products');
Route::middleware('privilege:view-vendor-products')->get('/dashboard/vendor/product_details/{id}', 'Dashboard\ProductController@showProductDetails')->name('vendor-products-details');
Route::middleware('privilege:add/edit/delete-vendor-products')->get('/dashboard/vendor/product/add_edit/{id?}', 'Dashboard\ProductController@create')->name('vendor-products');
Route::middleware('privilege:add/edit/delete-vendor-products')->get('/dashboard/product/add_edit/{vendor_id}', 'Dashboard\ProductController@createProduct')->name('vendor-products-ind');
Route::middleware('privilege:add/edit/delete-vendor-products')->post('/dashboard/vendor/product/saveUpdate', 'Dashboard\ProductController@store')->name('save-vendor-products');
Route::middleware('privilege:update-vendor-product-status')->get('/dashboard/vendor/product/status/{id}/{status}', 'Dashboard\ProductController@changeStatus')->name('changeStatus-vendor-products');
Route::middleware('privilege:add/edit/delete-vendor-products')->get('/dashboard/vendor/product/delete/{id}', 'Dashboard\ProductController@destroy')->name('delete-vendor-products');
Route::middleware('privilege:add/edit/delete-vendor-products')->post('/dashboard/vendor/product/upload_files', 'Dashboard\ProductController@uploadImages')->name('image-vendor-products');
Route::middleware('privilege:add/edit/delete-vendor-products')->get('/dashboard/vendor/product/uploaded_files/{product_id}', 'Dashboard\ProductController@uploadedImages')->name('image-vendor-products');
Route::middleware('privilege:add/edit/delete-vendor-products')->get('/dashboard/vendor/product/images/delete/{product_id}', 'Dashboard\ProductController@deleteProductImage')->name('delete-vendor-products-image');

//Product Specification
Route::middleware('privilege:view-product-specification-values')->get('/dashboard/vendor/products/specification_values/{id}', 'Dashboard\SpecificationValueController@index')->name('vendor-products-specification');
Route::middleware('privilege:add/edit/delete-product-specification-values')->post('/dashboard/vendor/products/specification_value/saveUpdate', 'Dashboard\SpecificationValueController@store')->name('save-vendor-products-specification');
Route::middleware('privilege:add/edit/delete-product-specification-values')->get('/dashboard/vendor/products/specification_value/delete/{id}', 'Dashboard\SpecificationValueController@destroy')->name('delete-vendor-products-specification');


// Specification
Route::middleware('privilege:view-product-specifications')->get('/dashboard/product-specifications', 'Dashboard\SpecificationController@index')->name('vendor-product-specification');
Route::middleware('privilege:add/edit/delete-product-specifications')->post('/dashboard/product-specifications/saveUpdate', 'Dashboard\SpecificationController@store')->name('save-vendor-product-specification');
Route::middleware('privilege:add/edit/delete-product-specifications')->get('/dashboard/product-specifications/edit/{id}', 'Dashboard\SpecificationController@create')->name('update-vendor-product-specification');
Route::middleware('privilege:add/edit/delete-product-specifications')->get('/dashboard/product-specifications/delete/{id}', 'Dashboard\SpecificationController@destroy')->name('delete-vendor-product-specification');

//Payment APIs
Route::middleware('privilege:view-payment-gateways')->get('/dashboard/payment-gateways', 'Dashboard\PaymentGatewayController@index')->name('payment-gateways');
Route::post('/dashboard/payment-gateway/save', 'Dashboard\PaymentGatewayController@updatePaymentGateway')->name('payment-apis');

//Menu
Route::middleware('privilege:view-menus')->get('/dashboard/menus', 'Dashboard\MenuController@index')->name('vendor-menus');
Route::middleware('privilege:add/edit/delete-menus')->post('/dashboard/menu/saveUpdate', 'Dashboard\MenuController@store');
Route::middleware('privilege:add/edit/delete-menus')->get('/dashboard/menu/delete/{id}', 'Dashboard\MenuController@destroy');

//Discount Settings
Route::middleware('privilege:view-discount-setting')->get('/dashboard/discount-settings', 'Dashboard\DiscountController@index')->name('admin-discount-setting');
Route::middleware('privilege:view-discount-setting')->get('/dashboard/discount-settings/enable/{type}', 'Dashboard\DiscountController@enableDiscount')->name('admin-discount-setting-enable');
Route::middleware('privilege:view-discount-setting')->post('/dashboard/discount-settings/save_update', 'Dashboard\DiscountController@updateDiscount')->name('admin-discount-setting-saveUpdate');

/*//Vendor General Setting
Route::get('/dashboard/vendor/vendor_setting', 'Dashboard\VendorSettingsController@index');
Route::post('/dashboard/vendor/vendor_info/save', 'Dashboard\VendorSettingsController@vendorSettingInfo');*/
Route::post('/dashboard/general_settings/shipping/save', 'Dashboard\SettingsController@store');


//Hero Slider
Route::middleware('privilege:view-hero-slider')->get('/dashboard/hero_slider', 'Dashboard\HeroSliderController@index');
Route::middleware('privilege:add/edit/delete-hero-slider')->post('/dashboard/hero_slider/upload_files', 'Dashboard\HeroSliderController@upload_files');
Route::middleware('privilege:add/edit/delete-hero-slider')->get('/dashboard/hero_slider/uploaded_files', 'Dashboard\HeroSliderController@uploadedImages');
Route::middleware('privilege:add/edit/delete-hero-slider')->post('/dashboard/hero_slider/uploads_update', 'Dashboard\HeroSliderController@update');
Route::middleware('privilege:add/edit/delete-hero-slider')->post('/dashboard/hero_slider/uploads_update_filename', 'Dashboard\HeroSliderController@update_filename');
Route::middleware('privilege:add/edit/delete-hero-slider')->post('/dashboard/hero_slider/uploads_delete_file', 'Dashboard\HeroSliderController@delete_file');

Route::middleware('privilege:view-vendor-orders')->get('/dashboard/vendor/orders', 'Dashboard\OrderController@index')->name('store-orders');
Route::middleware('privilege:view-vendor-orders')->get('/dashboard/vendor/order/{id}', 'Dashboard\OrderController@show')->name('store-orders-ind');
Route::post('/dashboard/vendor/order/edit', 'Dashboard\OrderController@store')->name('store-orders-status');
Route::middleware('privilege:view-vendor-order-history')->get('/dashboard/vendor/order-history', 'Dashboard\OrderController@orderHistory')->name('view-order-history');


Route::middleware('privilege:view-vendor-analytics')->get('/dashboard/vendor/analytics', 'Dashboard\DashboardController@storeAnalytics')->name('store-analytics');
Route::middleware('privilege:view-vendor-reports')->get('/dashboard/vendor/reports', 'Dashboard\DashboardController@storeIndex')->name('store-reports');

Route::middleware('privilege:view-vendor-requests')->get('/dashboard/vendor/request', 'Dashboard\UnitController@index')->name('store-requests');

//Homepage Layout
Route::middleware('privilege:view-homepage-layout')->get('/dashboard/homepage_layout', 'Dashboard\HomepageLayoutController@index')->name('homepage-layout');
Route::middleware('privilege:add/edit/delete-homepage-layout')->post('/dashboard/container_layout/addUpdate', 'Dashboard\HomepageLayoutController@store')->name('update-container-layout');
Route::middleware('privilege:add/edit/delete-homepage-layout')->post('/dashboard/card_layout/update', 'Dashboard\HomepageLayoutController@updateCardItem')->name('update-container-layout');
Route::middleware('privilege:add/edit/delete-homepage-layout')->post('/dashboard/homepage_layout/orders/update', 'Dashboard\HomepageLayoutController@updateOrder')->name('update-homepage-layout-order');
Route::middleware('privilege:add/edit/delete-homepage-layout')->get('/dashboard/homepage_layout/delete/{id}', 'Dashboard\HomepageLayoutController@destroy')->name('delete-homepage-layout');

/*Report Routes*/
Route::middleware('privilege:view-admin-reports')->get('dashboard/reports/vendor_transaction/{daterange?}','Dashboard\ReportController@vendor_transaction_report');
Route::middleware('privilege:view-admin-reports')->get('dashboard/reports/all_vendor_transaction/{daterange?}','Dashboard\ReportController@all_vendor_transaction_report');
Route::middleware('privilege:view-admin-reports')->get('dashboard/reports/payment_method/{daterange?}','Dashboard\ReportController@orders_by_paymentmethod');
Route::middleware('privilege:view-vendor-reports')->get('dashboard/vendor/reports/sales/{daterange?}','Dashboard\ReportController@sales_by_vendor');

/*Shipping Routes*/
Route::middleware('privilege:view-shipping-person')->get('dashboard/shipping/person/','Dashboard\ShippingController@index');
Route::middleware('privilege:add/edit/delete-shipping-person')->post('dashboard/shipping/person/saveUpdate','Dashboard\ShippingController@store');
Route::middleware('privilege:assign-shipping-person')->post('/dashboard/orders/assign_shipping_person/update','Dashboard\CartController@assignShippingPerson');

// Address Management
//District
Route::middleware('privilege:view-address-management')->get('dashboard/address/district','Dashboard\DistrictController@index');
Route::middleware('privilege:add/edit/delete-address')->post('dashboard/address/district/add_edit','Dashboard\DistrictController@store');
Route::middleware('privilege:add/edit/delete-address')->get('dashboard/address/district/delete/{id}','Dashboard\DistrictController@destroy');

//Province
Route::middleware('privilege:view-address-management')->get('dashboard/address/province','Dashboard\ProvinceController@index');
Route::middleware('privilege:add/edit/delete-address')->post('dashboard/address/province/add_edit','Dashboard\ProvinceController@store');
Route::middleware('privilege:add/edit/delete-address')->get('dashboard/address/province/delete/{id}','Dashboard\ProvinceController@destroy');

/*STORE EMPLOYEE PAGE ROUTES*/

/*SEARCH ROUTES*/
Route::post('/search/', 'Pub\SearchController@searchSubmit');
Route::post('/searchprice/', 'Pub\SearchController@searchPriceSubmit')->name('searchprice');
Route::get('/search/', 'Pub\SearchController@index')->name('search');
/*CLIENT VIEWABLE PAGE ROUTES*/
Route::get('/', 'Pub\PageController@index');
Route::post('/', 'Pub\PageController@index');
Route::get('/category/{id}', 'Pub\PageController@category');
Route::get('/product/{id}', 'Pub\PageController@product');
Route::get('/brand/{id}', 'Pub\PageController@brand');
Route::get('/vendor/{id}', 'Pub\PageController@vendor');
Route::get('register/vendor','Auth\VendorController@init')->name('public.vendor.registration.init');
Route::post('register/vendor','Auth\VendorController@register')->name('public.vendor.registration.store');

//cart
Route::get('/cart/shipping_charge/{value}/{cart_id}', 'Pub\PageController@calculateShipping');
Route::get('/courier/pickup_point/{id}', 'Pub\PageController@getCourier');

Route::middleware('privilege:view-self-cart')->get('/cart', 'Pub\OrderController@cart');
Route::middleware('privilege:add-to-cart')->post('/product/add-to-cart/{id}', 'Pub\OrderController@addToCart');
Route::middleware('privilege:manage-self-cart')->post('/cart/update/{id}', 'Pub\OrderController@updateCart');
Route::middleware('privilege:manage-self-cart')->get('/cart/delete/{id}', 'Pub\OrderController@deleteCart');
Route::middleware('privilege:manage-self-cart')->get('/cart/checkout/{cart_id}', 'Pub\OrderController@checkout');
//Route::middleware('privilege:manage-self-cart')->get('/cart/checkout/home/{cart_id}', 'Pub\PageController@checkoutHomeDelivery');
//Route::middleware('privilege:manage-self-cart')->get('/cart/checkout/pick/{cart_id}', 'Pub\PageController@checkoutPickup');
Route::middleware('privilege:manage-self-cart')->post('/cart/checkout/payment/{cart_id}', 'Pub\OrderController@checkoutPayment');
Route::middleware('privilege:manage-self-cart')->get('/order/checkout/payment/{order_id}', 'Pub\OrderController@checkoutPay');
Route::middleware('privilege:manage-self-cart')->get('/order/checkout/payment/cod/confirm/{order_id}', 'Pub\PaymentController@codValidate');
Route::middleware('privilege:manage-self-cart')->get('/order/cancel/{order_id}', 'Pub\PageController@cancelOrder');
Route::middleware('privilege:manage-self-cart')->post('/cart/checkout/updateAddress/{cart_id}', 'Pub\PageController@updateAddressAtCheckout');
Route::middleware('privilege:manage-self-account')->get('/customer/account', 'Pub\CustomerController@account');
Route::middleware('privilege:manage-self-account')->get('/customer/addresses', 'Pub\CustomerController@addresses');
Route::middleware('privilege:manage-self-account')->post('/customer/addresses/add/', 'Pub\CustomerController@addAddress');
Route::middleware('privilege:manage-self-account')->get('/customer/addresses/set_default_address/{id}', 'Pub\CustomerController@setDefaultAddress');
Route::middleware('privilege:manage-self-account')->get('/customer/addresses/delete_address/{id}', 'Pub\CustomerController@deleteAddress');
Route::middleware('privilege:manage-self-account')->get('/customer/security/', 'Pub\CustomerController@security');
Route::middleware('privilege:manage-self-account')->post('/customer/password/change/', 'Pub\CustomerController@updatePassword');
Route::middleware('privilege:manage-self-account')->post('/customer/email/change/', 'Pub\CustomerController@updateEmail');
Route::middleware('privilege:manage-self-account')->post('/customer/profile/update/', 'Pub\CustomerController@updateProfile');
Route::middleware('privilege:manage-self-cart')->get('/customer/orders/', 'Pub\CustomerController@orders')->name('customer-orders');
Route::middleware('privilege:manage-self-cart')->get('/customer/order/{id}', 'Pub\CustomerController@orderDetail');
Route::middleware('privilege:manage-self-cart')->get('/customer/wishlist/', 'Pub\WishlistController@index');
Route::middleware('privilege:manage-self-cart')->get('/customer/wishlist/toggle/{pid}', 'Pub\WishlistController@store');

/*Always Keep This At Last To Override*/
Route::get('/{slug}', 'Pub\PageController@page');
/*Always Keep This At Last To Override*/
