<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">{{$addEdit}} Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal"  novalidate method="post" action="/dashboard/store/employees/saveUpdate">
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
                                    <input type="text" required data-validation-required-message="Name field is required" id="name" class="form-control" name="name" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Email</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" required data-validation-required-message="Email field is required" id="email" class="form-control" name="email" placeholder="Enter Email">
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

