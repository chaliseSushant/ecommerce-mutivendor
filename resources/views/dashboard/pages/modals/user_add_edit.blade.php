<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">{{$addEdit}} User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate action="/dashboard/admin-user/saveUpdate" method="post">
            @csrf
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Name</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required data-validation-required-message="Name field is required" id="name" class="form-control" name="name" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        @if($saveUpdate =="Save")
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Password</span>
                                    </div>
                                    <div class="col-md-8 controls position-relative" >
                                        <input type="password" required data-validation-required-message="Password field is required" id="password" class="form-control" name="password" placeholder="Enter Password">
                                        <div class="form-control-position" style="right:15px">
                                            <span class="feather icon-eye toggle-password" toggle="#password"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <span>Confirm Password</span>
                                    </div>
                                    <div class="col-md-8 controls">
                                        <input type="password" required data-validation-match-match="password" data-validation-required-message="Confirm password must match the original Password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Email</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" required data-validation-required-message="Email field is required" id="email" class="form-control" name="email" placeholder="Enter Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Role</span>
                                </div>
                                <div class="col-md-8">
                                    <select id="role" class="form-control" name="role_id">
                                        <option value="0">Select Role...</option>
                                        @foreach($roles as $role)
                                            <option @if($role->name == "Customer" ) hidden @endif value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 vendor-role">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Vendor</span>
                                </div>
                                <div class="col-md-8">
                                    <select id="vendor" class="form-control" name="vendor_id">
                                        <option value="0">Select Vendor...</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">{{$saveUpdate}}</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>

    </div>
</div>
<script>
$(function(){
    $('.vendor-role').addClass('hidden');
    $('#role').on('change',function(){
        debugger;
        var vendor_name = $('#role option:selected').text();
        if(vendor_name==='Vendor')
            $('.vendor-role').removeClass('hidden');
        else
            $('.vendor-role').addClass('hidden');
    })
})
</script>
