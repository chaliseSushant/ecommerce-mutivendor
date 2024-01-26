<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" target="_blank" href="https://jackndeals.com">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">JackNDeals</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(Auth::user()->hasPrivilege('view-analytics')) <li class=" @if($name=='eCommerce') active @endif nav-item"><a href="{{url('/dashboard/analytics')}}"><i class="feather icon-activity"></i><span class="menu-title" data-i18n="Email">Analytics</span></a></li> @endif

        @if(Auth::user()->hasPrivilege('view-vendor-dashboard')) <li class=" nav-item"><a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                <ul class="menu-content">
                    @if(Auth::user()->hasPrivilege('view-vendor-analytics')) <li @if($name=='Store Analytics') class="active" @endif ><a href="{{url('/dashboard/vendor/analytics')}}"><i class="feather icon-activity"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a></li> @endif
                    {{--@if(Auth::user()->hasPrivilege('view-vendor-reports')) <li @if($name=='Store eCommerce') class="active" @endif ><a href="{{url('/dashboard/vendor/reports')}}"><i class="feather icon-bar-chart-2"></i><span class="menu-item" data-i18n="eCommerce">eCommerce</span></a></li> @endif--}}
                </ul>
            </li> @endif


            <li class=" navigation-header"><span>Ecommerce</span></li>


                @if(Auth::user()->hasPrivilege('view-vendor-manage-products')) <li class=" nav-item"><a href="#"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Ecommerce">Manage Products</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPrivilege('view-vendor-products')) <li @if($name=='Products') class="active" @endif ><a href="{{url('/dashboard/vendor/my_products')}}"><i class="feather icon-package"></i><span class="menu-item" data-i18n="Shop">Products</span></a> @endif
                        @if(Auth::user()->hasPrivilege('view-categories')) <li @if($name=='Categories') class="active" @endif ><a href="{{url('/dashboard/categories')}}"><i class="feather icon-list"></i><span class="menu-item" data-i18n="Shop">Categories</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-tags')) <li @if($name=='Tags') class="active" @endif ><a href="{{url('/dashboard/tags')}}"><i class="feather icon-hash"></i><span class="menu-item" data-i18n="Shop">Tags</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-brands')) <li @if($name=='Brands') class="active" @endif ><a href="{{url('/dashboard/brands')}}"><i class="feather icon-life-buoy"></i><span class="menu-item" data-i18n="Shop">Brands</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-product-specifications')) <li @if($name=='Product Specifications') class="active" @endif ><a href="{{url('/dashboard/product-specifications')}}"><i class="feather icon-tag"></i><span class="menu-item" data-i18n="Shop">Specifications</span></a></li> @endif
                    </ul>
                </li>
                @endif
                @if(Auth::user()->hasPrivilege('view-vendor-manage-outlets')) <li class=" @if($name=='Outlets') active @endif nav-item"><a href="{{url('/dashboard/vendor/outlets')}}"><i class="feather icon-server"></i><span class="menu-title" data-i18n="Email">Manage Outlets</span></a></li>  @endif


            @if(Auth::user()->hasPrivilege('view-products-attributes')) <li class=" nav-item"><a href="#"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Ecommerce">Product Attributes</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPrivilege('view-categories')) <li @if($name=='Categories') class="active" @endif ><a href="{{url('/dashboard/categories')}}"><i class="feather icon-list"></i><span class="menu-item" data-i18n="Shop">Categories</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-tags')) <li @if($name=='Tags') class="active" @endif ><a href="{{url('/dashboard/tags')}}"><i class="feather icon-hash"></i><span class="menu-item" data-i18n="Shop">Tags</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-brands')) <li @if($name=='Brands') class="active" @endif ><a href="{{url('/dashboard/brands')}}"><i class="feather icon-life-buoy"></i><span class="menu-item" data-i18n="Shop">Brands</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-product-specifications')) <li @if($name=='Product Specifications') class="active" @endif ><a href="{{url('/dashboard/product-specifications')}}"><i class="feather icon-tag"></i><span class="menu-item" data-i18n="Shop">Specifications</span></a></li> @endif
                    </ul>
                </li>
                @endif
                @if(Auth::user()->hasPrivilege('view-orders')) <li class=" @if($name=='Orders') active @endif nav-item"><a href="{{url('/dashboard/orders')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Email">Orders</span></a></li> @endif
                @if(Auth::user()->hasPrivilege('view-vendor-orders')) <li class=" @if($name=='Vendor Order') active @endif nav-item"><a href="{{url('/dashboard/vendor/orders')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Email">My Orders</span></a></li> @endif
                @if(Auth::user()->hasPrivilege('view-order-history')) <li class=" @if($name=='Order History') active @endif nav-item"><a href="{{url('/dashboard/vendor/order-history')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Email">Order History</span></a></li> @endif
                {{--@if(Auth::user()->hasPrivilege('view-communications')) <li class=" nav-item"><a href="#"><i class="feather icon-message-square"></i><span class="menu-title" data-i18n="Ecommerce">Communications</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPrivilege('view-feedbacks')) <li @if($name=='Feedbacks') class="active" @endif ><a href="{{url('/dashboard/feedbacks')}}"><i class="feather icon-octagon"></i><span class="menu-item" data-i18n="Shop">Feedbacks</span></a></li> @endif
                    </ul>
                </li>
                @endif--}}

            @if(Auth::user()->hasPrivilege('view-user-management'))<li class=" navigation-header"><span>User Management</span></li> @endif

            @if(Auth::user()->hasPrivilege('view-vendor-administrators'))
                    <li class=" nav-item"><a href="#"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Ecommerce">Manage Vendors</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPrivilege('view-vendors')) <li class=" @if($name=='Vendors') active @endif nav-item"><a href="{{url('/dashboard/vendors')}}"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Email">Vendors</span></a></li> @endif
                        @if(Auth::user()->hasPrivilege('view-vendor-requests')) <li class=" @if($name=='Vendor Requests') active @endif nav-item"><a href="{{url('/dashboard/vendor/requests/')}}"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Email">Vendors Request</span></a></li> @endif
                    </ul>
            </li>  @endif
            @if(Auth::user()->hasPrivilege('view-customers')) <li class=" @if($name=='Customers') active @endif nav-item"><a href="{{url('/dashboard/customers')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Customers</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-users')) <li class=" @if($name=='Users') active @endif nav-item"><a href="{{url('/dashboard/users')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Users</span></a></li> @endif
            @if(Auth::user()->hasPrivilege('view-roles')) <li class=" @if($name=='Roles') active @endif nav-item"><a href="{{url('/dashboard/roles')}}"><i class="feather icon-shield"></i><span class="menu-title" data-i18n="Email">Roles</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-privileges')) <li class=" @if($name=='Privileges') active @endif nav-item"><a href="{{url('/dashboard/privileges')}}"><i class="feather icon-lock"></i><span class="menu-title" data-i18n="Email">Privileges</span></a></li>  @endif

            @if(Auth::user()->hasPrivilege('view-employees')) <li class=" @if($name=='Employees') active @endif nav-item"><a href="{{url('/dashboard/vendor/employees')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Employees</span></a></li> @endif
            <li class="navigation-header"><span>Settings</span></li>
            @if(Auth::user()->hasPrivilege('view-payment-gateways')) <li class=" @if($name=='Payment Gateways') active @endif nav-item"><a href="{{url('/dashboard/payment-gateways')}}"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Email">Payment Gateways</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-vendor-general-setting')) <li class=" @if($name=='Vendor General Settings') active @endif nav-item"><a href="{{url('/dashboard/vendor/general-settings')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">General Settings</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-general-settings')) <li class=" @if($name=='General Settings') active @endif nav-item"><a href="{{url('/dashboard/general-settings')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">General Settings</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-vendor-types')) <li class=" @if($name=='Vendor Types') active @endif nav-item"><a href="{{url('/dashboard/vendor-types')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Vendor Types</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-discount-setting')) <li class=" @if($name=='Discount Settings') active @endif nav-item"><a href="{{url('/dashboard/discount-settings')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Discount Settings</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-page-manager')) <li class=" @if($name=='Page Manager') active @endif nav-item"><a href="{{url('/dashboard/pages')}}"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Email">Page Manager</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-shipping-person')) {{--Add all privileges of cchild menu here with or operator--}}
            <li class=" nav-item"><a href="#"><i class="feather icon-truck"></i><span class="menu-title" data-i18n="Ecommerce">Shipping</span></a>
                <ul class="menu-content">
                    @if(Auth::user()->hasPrivilege('view-shipping-person')) <li class=" @if($name=='Shipping Persons') active @endif nav-item"><a href="{{url('/dashboard/shipping/person')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Persons</span></a></li> @endif

                        {{--
                    @if(Auth::user()->hasPrivilege('view-shipping-settings')) <li class=" @if($name=='Shipping Settings') active @endif nav-item"><a href="{{url('/dashboard/vendor/requests/')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Setting</span></a></li> @endif
--}}
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPrivilege('view-address-management')) {{--Add all privileges of cchild menu here with or operator--}}
            <li class=" nav-item"><a href="#"><i class="feather icon-map"></i><span class="menu-title" data-i18n="Ecommerce">Address Management</span></a>
                <ul class="menu-content">
                    @if(Auth::user()->hasPrivilege('view-address-management')) <li class=" @if($name=='Province Management') active @endif nav-item"><a href="{{url('/dashboard/address/province')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Province</span></a></li> @endif
                    @if(Auth::user()->hasPrivilege('view-address-management')) <li class=" @if($name=='District Management') active @endif nav-item"><a href="{{url('/dashboard/address/district')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">District</span></a></li> @endif
{{--
                    @if(Auth::user()->hasPrivilege('view-shipping-settings')) <li class=" @if($name=='Shipping Settings') active @endif nav-item"><a href="{{url('/dashboard/vendor/requests/')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Setting</span></a></li> @endif
--}}
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPrivilege('view-reports')) {{--Add all privileges of cchild menu here with or operator--}}
            <li class=" nav-item"><a href="#"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Ecommerce">Reports</span></a>
                <ul class="menu-content">
                    @if(Auth::user()->hasPrivilege('view-admin-reports')) <li class=" @if($name=='Vendor Transaction Report') active @endif nav-item"><a href="{{url('dashboard/reports/vendor_transaction/')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">Vendor Transaction</span></a></li> @endif
                    @if(Auth::user()->hasPrivilege('view-admin-reports')) <li class=" @if($name=='All Vendor Transaction Report') active @endif nav-item"><a href="{{url('dashboard/reports/all_vendor_transaction/')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">All Vendor Transaction</span></a></li> @endif
                    @if(Auth::user()->hasPrivilege('view-admin-reports')) <li class=" @if($name=='Payment Method Report') active @endif nav-item"><a href="{{url('dashboard/reports/payment_method/')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Payment Method</span></a></li> @endif
                    @if(Auth::user()->hasPrivilege('view-vendor-reports')) <li class=" @if($name=='Vendor Sales Report') active @endif nav-item"><a href="{{url('dashboard/vendor/reports/sales/')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Email">Sales</span></a></li> @endif
                </ul>
            </li>
            @endif
            {{--@if(Auth::user()->hasPrivilege('view-units')) <li class=" @if($name=='Units') active @endif nav-item"><a href="{{url('/dashboard/units')}}"><i class="feather icon-percent"></i><span class="menu-title" data-i18n="Email">Units</span></a></li>  @endif--}}
            @if(Auth::user()->hasPrivilege('view-homepage-layout')) <li class=" @if($name=='Homepage Layout') active @endif nav-item"><a href="{{url('/dashboard/homepage_layout')}}"><i class="feather icon-layout"></i><span class="menu-title" data-i18n="Email">Homepage Layout</span></a></li>  @endif
            @if(Auth::user()->hasPrivilege('view-hero-slider')) <li class=" @if($name=='Hero Slider') active @endif nav-item"><a href="{{url('/dashboard/hero_slider')}}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="Email">Hero Slider</span></a></li>  @endif

            @if(Auth::user()->hasPrivilege('view-vendor-payment-apis')) <li class=" @if($name=='Payment APIs') active @endif nav-item"><a href="{{url('/dashboard/vendor/payment-apis')}}"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Email">Payment APIs</span></a></li> @endif
            @if(Auth::user()->hasPrivilege('view-menus')) <li class=" @if($name=='Menus') active @endif nav-item"><a href="{{url('/dashboard/menus')}}"><i class="feather icon-menu"></i><span class="menu-title" data-i18n="Email">Menus</span></a></li> @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
