<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">{{$addEdit}} Role</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate action="/dashboard/role/saveUpdate" method="post">
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
                                    <input type="text" id="name" required data-validation-required-message="Name field is required" class="form-control" name="name" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Order</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" id="order" required data-validation-required-message="Order field is required" class="form-control" name="order" placeholder="Enter Order">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Description</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <textarea type="text" rows="3" required data-validation-required-message="Description field is required" id="description" class="form-control" name="description" placeholder="Enter Description"></textarea>
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
