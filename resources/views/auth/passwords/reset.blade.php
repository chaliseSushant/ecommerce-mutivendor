@extends('frontend.layouts.app')
@section('content')
    <div class="page-wrapper offwhite">
        <div class="row justify-content-center">
        <div class="col-8 col-lg-4 col-md-6 col-sm-8">
            <div class="card login-register mt-3 mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="row text-center">
                            <div class="col-12 title"><h6>{{ __('Reset Password') }}</h6></div>
                        </div>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group container">
                            <label for="email" class="col-form-label">Email</label>
                            <input id="email" type="email" class="col-12 form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                        <div class="form-group container mb-0">
                            <div class="action-group">
                                <button type="submit" class="btn btn-warning full-width-btn">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
