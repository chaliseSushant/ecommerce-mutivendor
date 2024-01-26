<span class="cursor-pointer dropdown auth">
    <div class="dropbtn @if(auth::check()) active @endif"><i class="fa fa-user-o" aria-hidden="true"></i>
        @if(auth::check())
            <span class="logged-in-state">
                Namaste<br><strong style="float:right;">{{explode(' ',auth::user()->name)[0]}}</strong>
            </span>
        @else
            <div class="logged-out-state">
            <strong>Login</strong>
            </div>
        @endif
    </div>
    <div class="dropdown-content" style="text-align: left">
        @if(auth::check())
            @if(auth::user()->hasRole('customer'))
                <a href="{{url('/cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                <a href="{{url('/customer/orders')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Orders</a>
                <a href="{{url('/customer/wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</a>
                <a href="{{url('/customer/account')}}"><i class="fa fa-lock" aria-hidden="true"></i></i> Account</a>
            @elseif(auth::user()->hasRole('vendor') || auth::user()->hasRole('admin') || auth::user()->hasRole('employee'))
                <a href="{{url('/dashboard')}}"><i class="fa fa-cogs" aria-hidden="true"></i> View Dashboard</a>
                <a href="{{url('/generic_vendor_assets.zip')}}" download=""><i class="fa fa-download" aria-hidden="true"></i> Download Vendor Assets</a>
            @else
            @endif
                <hr>
                <a href="{{url('/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        @else
            <a href="{{url('/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
            <a href={{url('/register')}}><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
            <hr>
            <a href="{{url('/register/vendor')}}"><i class="fa fa-handshake-o" aria-hidden="true"></i> Register as a Vendor</a>
        @endif
    </div>
</span>
