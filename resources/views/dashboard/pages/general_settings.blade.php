@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="row">
            <div class="col-12">
               <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Shipping Setting</h4>
                    </div>
                   <div class="card-body">
                       <form role="form" method="post" novalidate action="/dashboard/general_settings/shipping/save">
                           @csrf
                           {{--<input type="hidden" name="id" @if(isset($store_info)) value="{{$store_info->id}}" @endif>--}}
                           <div class="form-group">
                               <div class="row">
                                   <div class="col-6">
                                       <div class="row">
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" value="1" id="shipping_type1" @if($shipping_setting->shipping_type == 1) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type1">Base Shipping Per Vendor with Additional Shipping Per Quantity</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type2" value="2"  @if($shipping_setting->shipping_type == 2) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type2">Base Shipping Per Order with Additional Shipping Per Quantity</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type3" value="3"  @if($shipping_setting->shipping_type == 3) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type3">Base Shipping Per Order with Additional Shipping Per Item</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type4" value="4"  @if($shipping_setting->shipping_type == 4) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type4">Base Shipping Per Order without Additional Shipping Charges</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type5" value="5"  @if($shipping_setting->shipping_type == 5) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type5">Default Shipping Charge Policy</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type6" value="6"  @if($shipping_setting->shipping_type == 6) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type6">Default Shipping Charge with Minimum Order Free</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group controls">
                                                   <fieldset>
                                                       <div class="custom-control custom-radio">
                                                           <input type="radio" class="custom-control-input" name="shipping_type" id="shipping_type7" value="7"  @if($shipping_setting->shipping_type == 7) checked @endif>
                                                           <label class="custom-control-label" for="shipping_type7">Free Shipping</label>
                                                       </div>
                                                   </fieldset>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-6">
                                       <div class="row">
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <div class="col-12">
                                                       <div class="form-group">
                                                           <label>Default Shipping Charge</label>
                                                           <input type="text" id="default_shipping_charge" value="{{$shipping_setting->default_shipping_charge}}" class="form-control" name="default_shipping_charge" placeholder="Default Shipping Charge">
                                                       </div>
                                                   </div>
                                                   <div class="col-12">
                                                       <div class="form-group">
                                                           <label>Minimum Order Amount</label>
                                                           <input type="text" id="minimum_order_amount" value="{{$shipping_setting->minimum_order_amount}}" class="form-control" name="minimum_order_amount" placeholder="Min Order Amount">
                                                       </div>
                                                   </div>

                                               </div>
                                           </div>
                                       </div>
                                   </div>



                               </div>
                               <div class="row">
                                   <div class="col-3">
                                       <button type="submit" class="btn btn-primary mr-1 mt-2">Update</button>
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
