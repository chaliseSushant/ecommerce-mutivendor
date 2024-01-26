<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal"  method="post" action="{{url('/dashboard/vendor/outlet/saveUpdate')}}">
            @csrf
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>
                        <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor_id}}">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Name</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" required data-validation-required-message="Name field is required" id="name" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Address 1</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <textarea required data-validation-required-message="Address 1 field is required" id="address_01" class="form-control" name="address_01" placeholder="Address 1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Address 2</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <textarea id="address_02" class="form-control" name="address_02" placeholder="Address 2"></textarea>
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
                                    <span>District</span>
                                </div>
                                <div class="col-md-8">
                                    <select name="district_id" id="district" class="form-control district">
                                    </select>
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
