<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">Update Layout Item</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate method="post" action="/dashboard/container_layout/addUpdate">
            @csrf
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Template</span>
                                </div>
                                <div class="col-md-8">
                                        <select class="form-control" name="template_id" id="template">
                                            @foreach($templates as $template)
                                                <option value="{{$template->id}}">{{$template->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Title</span>
                                </div>
                                <div class="col-md-8">
                                       <input name="title" id="title" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Type</span>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control type" id="type" name="type">
                                        <option value="banner">Banner</option>
                                        <option value="category">Category</option>
                                        <option value="brand">Brand</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 not-banner">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span></span>
                                </div>
                                <div class="col-md-8">
                                    <select id="type_id" class="form-control" name="type_id">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 banner">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Image</span>
                                </div>
                                <div class="col-md-8">
                                    <input name="image" type="file" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 banner">
                            <div class="form-group row">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-8">
                                    <img style="height:100px; width:100px;display: none;" id="icon-image" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 banner">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>URL</span>
                                </div>
                                <div class="col-md-8">
                                    <input name="url" type="text" id="url" class="form-control">
                                </div>
                            </div>
                        </div>

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
<script>

</script>
