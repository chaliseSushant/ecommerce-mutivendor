<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">Update Card Item</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate method="post" action="/dashboard/card_layout/update" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <input name="id" id="id" type="hidden"/>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <span>Type</span>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control card_type" name="type" id="type">
                                        <option value="none">None</option>
                                        <option value="category">Category</option>
                                        <option value="product">Product</option>
                                        <option value="brand">Brand</option>
                                        <option value="banner">Banner</option>
                                    </select>
                                    {{--<ul class="list-unstyled mb-0">

                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input card_type" name="type" value="category" id="card_category" checked>
                                                    <label class="custom-control-label" for="card_category">Category</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input card_type" value="product" name="type" id="card_product">
                                                    <label class="custom-control-label" for="card_product">Product</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input card_type" value="brand" name="type" id="card_brand">
                                                    <label class="custom-control-label" for="card_brand">Brand</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input card_type" value="banner" name="type" id="card_banner">
                                                    <label class="custom-control-label" for="card_banner">Banner</label>
                                                </div>
                                            </fieldset>
                                        </li>

                                    </ul>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 not-banner">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span></span>
                                </div>

                                <div class="col-md-8">
                                    <select id="card_type_id" class="form-control" name="type_id">

                                        @foreach(\App\Category::all('id','name') as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
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
