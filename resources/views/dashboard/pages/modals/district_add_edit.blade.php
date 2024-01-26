<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" method="post" novalidate action="{{url('dashboard/address/district/add_edit')}}">
            @csrf
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Name</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" id="name" required data-validation-required-message="Name field is required" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Province</span>
                                </div>
                                <div class="col-md-8">
                                    <select name="province_id" id="province" class="form-control">
                                        @foreach(\App\Province::orderBy('name','asc')->pluck('id','name') as $key=>$value))
                                        <option value="{{$value}}">{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Enable Delivery</span>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                        <input type="checkbox" class="custom-control-input status" name="is_enabled" id="switch-delivery">
                                        <label class="custom-control-label" for="switch-delivery">
                                            <span class="switch-text-left">Yes</span>
                                            <span class="switch-text-right">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Enable Vendor</span>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                        <input type="checkbox" class="custom-control-input status" name="is_enabled_vendor" id="switch-vendor_enabled">
                                        <label class="custom-control-label" for="switch-vendor_enabled">
                                            <span class="switch-text-left">Yes</span>
                                            <span class="switch-text-right">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Enable Cash on Delivery</span>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                        <input type="checkbox" class="custom-control-input status" name="cod_enabled" id="switch-cod_delivery">
                                        <label class="custom-control-label" for="switch-cod_delivery">
                                            <span class="switch-text-left">Yes</span>
                                            <span class="switch-text-right">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Save</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>

    </div>
</div>
