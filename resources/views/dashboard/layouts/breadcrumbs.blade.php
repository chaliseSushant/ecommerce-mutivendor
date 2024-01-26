<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{$name}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">{{$name}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->hasRole('vendor') && Auth::user()->vendor->approved_at == null)
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Please submit all the necessary vendor details to start selling. If you have any enquiry, please call us at: {{config('app.vendor-jnd-contact')}}.
            </div>
        </div>
    @endif
    @if(Auth::user()->hasRole('vendor') && Auth::user()->vendor->status != 1)
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            Your vendor account has been deactivated. For enquiry, please call us at: {{config('app.vendor-jnd-contact')}}.
        </div>
    </div>
    @endif
</div>
