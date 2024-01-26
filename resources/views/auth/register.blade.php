@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper offwhite">
        <div class="row  justify-content-center">
            <div class="col-11 col-lg-4 col-md-6 col-sm-11">
                <div class="card login-register mt-3 mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row text-center">
                                <div class="col-12 title"><h6>Customer Registration</h6></div>
                            </div>
                            <div class="form-group container">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group container">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="email" class="col-12 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group container">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="col-12 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group container">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="col-12 form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group container mb-5">
                                <div class="action-group">
                                    <button type="submit" class="btn btn-warning full-width-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            {{--<div class="form-group container mb-5">
                                <div class="action-group">
                                    <a class="btn btn-link" href="{{url('/login')}}">
                                        {{ __('Already Have An Account? Click Here To Login') }}
                                    </a>
                                </div>
                            </div>--}}
                            <div class="form-group container">
                                <div class="or-seperator"><i>or</i></div>
                                <p class="text-center">Continue with your social media account</p>
                                <div class="form-group social-btn mb-2">
                                    <a href="{{url('login/google')}}" class="btn btn-danger full-width-btn"><i class="fa fa-google"></i>&nbsp; Continue with Google</a>
                                </div>
                                <div class="form-group social-btn mb-2">
                                    <a href="{{url('login/facebook')}}" class="btn btn-secondary full-width-btn"><i class="fa fa-facebook"></i>&nbsp; Continue with Facebook</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted small mb-1">Already have an account? <a href="{{url('/login')}}">Login here!</a></p>
                <p class="text-center text-muted small">Want to be a seller? <a href="{{url('register/vendor')}}">Register as a vendor here!</a></p>

            </div>
        </div>
    </div>
@endsection
