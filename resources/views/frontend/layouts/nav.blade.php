<section class="topnav">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact">
                <span><a href="tel:+9779742559746">+977-9742559746</a></span>
                <span><a href="mailto:info@jackndeals.com">info@jackndeals.com</a></span>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 navigation">
                <span><a href="{{url('/register/vendor')}}">BE A SELLER</a></span>
                <span><a href="{{url('/support')}}">NEED SUPPORT</a></span>
            </div>
        </div>
    </div>
</section>
<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 justify-content-sm-center justify-content-xs-center brand-logo">
                <a href="{{url('/')}}"><img src="{{url('/frontend/images/brandlogo.png')}}"></a>
            </div>
            {{--<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 justify-content-sm-center justify-content-xs-center searchbar-wrapper">
                <div class="searchbar">
                    <form action="{{url('/search')}}" method="post">
                        @csrf
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>--}}
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 searchbar-wrapper">
                    <div class=" searchbar row">
                        <div class="col-12">
                            <form class="row" method="post" action="{{url('/search')}}">
                                @csrf
                                <div class="input-group col-12">
                                    <input type="text" placeholder="Search.." name="search" autocomplete="off" @if(isset($term))value="{{$term}}" @endif>
                                    <div class="input-group-append">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            <div class="col-lg-3 col-md-4 d-lg-block d-md-block d-sm-none d-xs-none d-none action-nav">
                @include('frontend.layouts.nav-auth')
                @include('frontend.layouts.nav-notification')
                <span class="cart-icon">
                    <a href="{{url('/cart')}}">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
                @if(auth::check() && auth::user()->unreadNotifications->count() > 0)
                <span class="badge badge-notify">{{auth::user()->unreadNotifications->count()}}</span>
                @endif
                @if(auth::check() && auth::user()->countCartItems() > 0)
                    <span class="badge badge-notify">{{auth::user()->countCartItems()}}</span>
                @endif
                </span>

            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @foreach($menus as $menu)
                    @if(count($menu->childs))
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ count($menu->childs) ? 'dropdown-toggle' :'' }}" href="{{url($menu->url)}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$menu->name}}
                            </a>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                @if(count($menu->childs))
                                    @include('frontend.layouts.nav-child',['childs' => $menu->childs])
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"> <a class="nav-link" href="{{url($menu->url)}}">{{$menu->name}}</a> </li>
                    @endif
                @endforeach
                    @if(auth::check())
                            <li class="nav-item dropdown d-xl-none d-md-none d-lg-none">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                                <ul class="dropdown-menu">
                                    <li>
                                    @if(auth::user()->hasRole('customer'))
                                        <a class="dropdown-item" href="{{url('/cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        <a class="dropdown-item" href="{{url('/customer/orders')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Orders</a>
                                        <a class="dropdown-item" href="{{url('/customer/wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</a>
                                        <a class="dropdown-item" href="{{url('/customer/account')}}"><i class="fa fa-lock" aria-hidden="true"></i></i> Account</a>
                                    @elseif(auth::user()->hasRole('vendor') || auth::user()->hasRole('admin') || auth::user()->hasRole('employee'))
                                        <a class="dropdown-item" href="{{url('/dashboard')}}"><i class="fa fa-cogs" aria-hidden="true"></i> View Dashboard</a>
                                        <a class="dropdown-item" href="{{url('/generic_vendor_assets.zip')}}" download><i class="fa fa-download" aria-hidden="true"></i> Download Vendor Assets</a>
                                    @endif
                                        <a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(!auth::check())
                        <li class="nav-item  d-xl-none d-md-none d-lg-none">
                            <a class="nav-link" href="{{url('/login')}}">Login</a>
                        </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>

