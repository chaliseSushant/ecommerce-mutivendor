@extends('frontend.layouts.app')

@section('content')
    <div class="page-wrapper offwhite">
        <div class="row justify-content-center">

            <div class="col-8 col-lg-4 col-md-6 col-sm-8">
                <div class="card login-register mt-3 mb-3">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row text-center">
                                <div class="col-12 title"><h6>{{ __('Reset Password') }}</h6></div>
                            </div>
                            <div class="form-group container">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="col-12 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group container mb-0">
                                <div class="action-group">
                                    <button type="submit" class="btn btn-warning full-width-btn">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted small mb-1"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; <a href="{{url('/login')}}">Go back</a></p>
            </div>
        </div>
    </div>
@endsection
