<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">{{$addEdit}} Privilege</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate method="post" action="{{url('/dashboard/privilege/save')}}">
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
                                    <input type="text" required data-validation-required-message="Name field is required" id="name" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Privilege</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" required data-validation-required-message="Privilege field is required" id="privilege" class="form-control" name="privilege" placeholder="Privilege">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Description</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <textarea id="description"  required data-validation-required-message="Description field is required" rows="4" class="form-control" name="description" placeholder="Description"></textarea>

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
