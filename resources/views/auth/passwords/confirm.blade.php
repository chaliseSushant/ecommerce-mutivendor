@extends('frontend.layouts.app')

@section('content')
<div class="page-wrapper offwhite">
    <div class="row justify-content-center">
        <div class="col-8 col-lg-4 col-md-6 col-sm-8">
            <div class="card login-register mt-3 mb-3">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 title"><h6>{{ __('Confirm Password') }}</h6></div>
                        <p class="col-12 text-center text-muted">{{ __('Please confirm your password before continuing.') }}</p>
                    </div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group container">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                        <div class="form-group container mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-warning full-width-btn">
                                    {{ __('Confirm Password') }}
                                </button>

                                {{--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
