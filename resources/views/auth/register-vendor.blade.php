@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper offwhite">
        <div class="row  justify-content-center">
            <div class="col-11 col-lg-4 col-md-6 col-sm-11">
                <div class="card login-register mt-3 mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('public.vendor.registration.store') }}">
                            @csrf
                            <div class="row text-center">
                                <div class="col-12 title"><h6>Vendor Registration</h6></div>
                            </div>
                            <div class="form-group container">
                                <div class="or-seperator"><i>Personal Details</i></div>
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

                            <div class="form-group container">
                                <div class="or-seperator"><i>Business Details</i></div>
                                <label for="name" class="col-form-label">Business' Name</label>
                                <input id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="vendor_name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group container">
                                <label for="name" class="col-form-label">Phone Number</label>
                                <input id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="vendor_phone" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group container">
                                <label for="name" class="col-form-label">Alternate Phone Number</label>
                                <input id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="vendor_phone_2" value="{{ old('name') }}">
                            </div>
                            <div class="form-group container">
                                <label for="name" class="col-form-label">Business Email</label>
                                <input id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="vendor_email" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group container">
                                <label for="name" class="col-form-label">Business Registered Address</label>
                                <textarea id="name" type="text" class="col-12 form-control @error('name') is-invalid @enderror" name="vendor_address" required></textarea>
                            </div>
                            <div class="form-group container mb-5">
                                <div class="action-group">
                                    <button type="submit" class="btn btn-warning full-width-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted small mb-1">Already have an account? <a href="{{url('/login')}}">Login here!</a></p>
                <p class="text-center text-muted small">Not a seller? <a href="{{url('/register')}}">Register as a customer here!</a></p>

            </div>
        </div>
    </div>
@endsection
