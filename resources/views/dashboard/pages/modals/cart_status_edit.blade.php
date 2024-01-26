<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">Update {{$type}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate method="post" @if($type =="Status") action="{{url('/dashboard/order/cart_item/change_status/')}}" @elseif($type=="Shipping Person") action="{{url('/dashboard/orders/assign_shipping_person/update')}}" @endif>
            @csrf
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>
                        @if($type =="Status")
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Type</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <select class="form-control" name="type">
                                        <option value="accept">Accept</option>
                                        <option value="dispatch">Dispatch</option>
                                        <option value="deliver">Deliver</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Date and Time</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" data-language="en" required data-validation-required-message="Datetime field is required" id="datetime" data-timepicker="true" data-time-format='hh:ii'  class="form-control datepicker-here" name="datetime" placeholder="DateTime">
                                </div>
                            </div>
                        </div>
                            @elseif($type == "Shipping Person")
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Shipping Person</span>
                                    </div>
                                    <div class="col-md-8 controls">
                                        <select name="shipping_person" class="form-control full-width">
                                            @foreach(\App\ShippingPerson::where('is_available','=',1)->get() as $shipping_person)
                                                <option value="{{$shipping_person->id}}">{{$shipping_person->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Update</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

