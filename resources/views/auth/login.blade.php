@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper offwhite">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-4 col-md-6 col-sm-11">
                <div class="card login-register mt-3 mb-3">
                    <div class="card-body">
                        @if (session('vendor_registration_success'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Vendor has been successfully registered. Please login and upload all the required documents to enable all features.') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row text-center">
                                <div class="col-12 title"><h6>Customer Login</h6></div>
                            </div>
                            <div class="form-group container">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="email" class="col-12 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group container">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="col-12 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (Route::has('password.request'))
                                    <div class="action-group">
                                        <p class="text-right text-muted small">
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group container">
                                <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                            </div>
                            <div class="form-group container mb-5">
                                <div class="action-group">
                                    <button type="submit" class="btn btn-warning full-width-btn">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                                {{--<div class="action-group container">
                                    <a class="btn btn-link" href="{{url('/register')}}">
                                        {{ __('Register') }}
                                    </a>
                                </div>--}}
                             <div class="form-group container">
                                 <div class="or-seperator"><i>or</i></div>
                                 <p class="text-center">Login with your social media account</p>
                                 <div class="form-group social-btn mb-2">
                                     <a href="{{url('login/google')}}" class="btn btn-danger full-width-btn"><i class="fa fa-google"></i>&nbsp; Sign in using Google</a>
                                 </div>
                                 <div class="form-group social-btn mb-2">
                                     <a href="{{url('login/facebook')}}" class="btn btn-secondary full-width-btn"><i class="fa fa-facebook"></i>&nbsp; Sign in using Facebook</a>
                                 </div>
                             </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted small mb-1">Don't have an account? <a href="{{url('/register')}}">Register here!</a></p>
                <p class="text-center text-muted small">Want to be a seller? <a href="{{url('register/vendor')}}">Register as a vendor here!</a></p>
            </div>
        </div>
    </div>
@endsection
