@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="row">
            <div class="col-12">
               <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Esewa</h4>
                    </div>
                   <div class="card-body">
                       <form role="form" method="post" novalidate action="/dashboard/payment-gateway/save">
                           @csrf
                           <input type="hidden" name="type" value="esewa">
                           <input type="hidden" name="id" @if(isset($payment_gateway)) value="{{$payment_gateway->id}}" @endif>
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-12">
                                       <fieldset>
                                           <div class="vs-checkbox-con vs-checkbox-success controls">
                                               <input @if(isset($payment_gateway) && $payment_gateway->esewa_enable==1) checked @endif name="enable_esewa" type="checkbox">
                                               <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                    </span>
                                               <span class="">Enable</span>
                                           </div>
                                       </fieldset>
                                   </div>

                               </div>

                               <div class="row">
                                   <div class="col-5">
                                       <div class="form-group controls">
                                           <label for="first-name-vertical">Secret Key</label>
                                           <input type="text" required data-validation-required-message="Secret Key field is required" @if(isset($payment_gateway)) value="{{$payment_gateway->esewa_secret_key}}" @endif id="esewa_secret_key" class="form-control" name="esewa_secret_key" placeholder="Secret Key">
                                       </div>
                                   </div>
                                   <div class="col-5">
                                       <div class="form-group controls">
                                           <label for="first-name-vertical">Public Key</label>
                                           <input type="text" required data-validation-required-message="Public Key field is required" @if(isset($payment_gateway)) value="{{$payment_gateway->esewa_public_key}}" @endif id="esewa_public_key" class="form-control" name="esewa_public_key" placeholder="Public Key">
                                       </div>
                                   </div>
                                   <div class="col-2">
                                       <button type="submit" class="btn btn-primary mr-1 mt-2">Update</button>
                                   </div>
                               </div>
                           </div>
                       </form>

                   </div>
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Khalti</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" novalidate action="/dashboard/payment-gateway/save">
                            @csrf
                            <input type="hidden" name="type" value="khalti">
                            <input type="hidden" name="id" @if(isset($payment_gateway)) value="{{$payment_gateway->id}}" @endif>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                <input type="checkbox"  @if(isset($payment_gateway) && $payment_gateway->khalti_enable==1) checked @endif name="enable_khalti" >
                                                <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                                </span>
                                                <span class="">Enable</span>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group controls">
                                            <label for="first-name-vertical">Secret Key</label>
                                            <input type="text" required data-validation-required-message="Secret Key field is required" @if(isset($payment_gateway)) value="{{$payment_gateway->khalti_secret_key}}" @endif id="khalti_secret_key" class="form-control" name="khalti_secret_key" placeholder="Secret Key">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group controls">
                                            <label for="first-name-vertical">Public Key</label>
                                            <input type="text" required data-validation-required-message="Public Key field is required" @if(isset($payment_gateway)) value="{{$payment_gateway->khalti_public_key}}" @endif id="khalti_public_key" class="form-control" name="khalti_public_key" placeholder="Public Key">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary mr-1 mt-2">Update</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Fonepay</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" novalidate action="/dashboard/payment-gateway/save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="fonepay">
                            <input type="hidden" name="id" @if(isset($payment_gateway)) value="{{$payment_gateway->id}}" @endif>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset>
                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                <input type="checkbox"  @if(isset($payment_gateway) && $payment_gateway->fonepay_enable==1) checked @endif name="enable_fonepay">
                                                <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                        </span>
                                                <span class="">Enable</span>
                                            </div>
                                        </fieldset>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group controls">
                                            <label for="first-name-vertical">QR Code Image</label>
                                            <input type="file" id="fonepay_qr"  class="form-control" name="fonepay_qr">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary mr-1 mt-2">Update</button>
                                    </div>
                                    <div class="col-2">
                                        <img style="height: 100px; width: 100px;"  src="@if(isset($payment_gateway->fonepay_qr)) {{$payment_gateway->fonepay_qr}} @endif"/>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
