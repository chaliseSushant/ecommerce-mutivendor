<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">{{$addEdit}} Menu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" novalidate method="post" action="/dashboard/menu/saveUpdate">
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
                                    <input type="text" id="name" required data-validation-required-message="Name field is required" class="form-control" name="name" placeholder="Menu Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Menu Order</span>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group input-group-lg controls">
                                        <input type="number" class="touchspin" required data-validation-required-message="Order field is required" id="order" name="order"  min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Parent Menu</span>
                                </div>
                                <div class="col-md-8">
                                    <select id="parent" class="form-control" name="parent">
                                        <option value="0">No Parent</option>
                                        @foreach($child_menus as $child_menu)
                                            <option value="{{$child_menu->id}}">{{$child_menu->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>Type</span>
                                </div>

                                <div class="col-md-8">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input type" name="type" value="none" id="none" checked>
                                                    <label class="custom-control-label" for="none">None</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        @if($saveUpdate == "Save")
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input type" name="type" value="category" id="category">
                                                    <label class="custom-control-label" for="category">Category</label>
                                                </div>
                                            </fieldset>
                                        </li>

                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input type" value="product" name="type" id="product">
                                                    <label class="custom-control-label" for="product">Product</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input type" value="brand" name="type" id="brand">
                                                    <label class="custom-control-label" for="brand">Brand</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if($saveUpdate == "Save")
                        <div class="col-12 ">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span></span>
                                </div>
                                <div class="col-md-8">
                                    <select id="type" class="form-control" name="type_id">

                                    </select>
                                </div>
                            </div>
                        </div>

                            @endif
                        <div class="col-12 url">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <span>URL</span>
                                </div>
                                <div class="col-md-8 controls">
                                    <input type="text" class="form-control" id="url" name="url">
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

    $('.type').on('click',function () {
        var name = $(this).attr('id');
        var data = "";
        if(name ==="brand")
             data = @json(App\Brand::all()->pluck('id','name'));
        else if(name ==="product")
             data = @json(App\Product::all()->pluck('id','name'));
        else if(name ==="category")
             data = @json(App\Category::all()->pluck('id','name'));
        $('#type').html("");
        $.each(data, function(key, value){
            $('#type').append('<option value="'+value+'">'+key+'</option>');
        });

        $('.url').hide();
        if(name ==="none")
            $('.url').show();
    })
</script>
