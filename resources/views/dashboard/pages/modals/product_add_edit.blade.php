@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Please Fill up the product information</h3>

                    </div>
                    <hr/>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" novalidate method="post" action="/dashboard/vendor/product/saveUpdate" enctype="multipart/form-data">
                                @csrf
                                <input name="id" type="hidden" @if(isset($products)) value="{{$products->id}} @endif">
                                 @if(Auth::user()->hasPrivilege('manage-multiple-vendor-product'))
                                 <input type="hidden" name="vendor_id"  value="@if(isset($products->vendor_id)){{$products->vendor_id}}@else{{$vendor_id}}@endif" />
                                 @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>SKU</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text" id="sku" required data-validation-required-message="SKU field is required" @if(isset($products)) value="{{$products->sku}}" @endif class="form-control" name="sku" placeholder="Enter SKU">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Name</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text" id="name" required data-validation-required-message="Name field is required" @if(isset($products)) value="{{$products->name}}" @endif class="form-control" name="name" placeholder="Enter Product Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Description</span>
                                                </div>
                                                <div class="col-md-8 controls">

                                                    <textarea id="editor" rows="5" required data-validation-required-message="Description field is required" class="form-control" name="description"   placeholder="Enter Product Description">@if(isset($products)) {{$products->description}} @endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text" id="price" required data-validation-required-message="Price field is required" class="form-control" @if(isset($products)) value="{{$products->price}}" @endif name="price" placeholder="Enter Price of Product">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Value</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text" id="value" required data-validation-required-message="Value field is required" s class="form-control" @if(isset($products)) value="{{$products->value}}" @endif name="value" placeholder="Enter Value of Product">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Display Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text"  id="display_price" required data-validation-required-message="Display Price field is required" class="form-control" @if(isset($products)) value="{{$products->display_price}}" @endif name="display_price" placeholder="Enter Display Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>In Stock</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                                        <input type="checkbox" name="stock" @if(isset($products) && $products->stock==1) checked @endif class="custom-control-input"  id="switch-stock">
                                                        <label class="custom-control-label" for="switch-stock">
                                                            <span class="switch-text-left">Yes</span>
                                                            <span class="switch-text-right">No</span>
                                                        </label>
                                                    </div>                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Category</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <select  id="category" required data-validation-required-message="Category field is required" name="category[]" class="form-control select2">

                                                        @foreach($categories as $category)
                                                            @if($category->hasChild())
                                                                <optgroup label="{{$category->name}}">
                                                                    @foreach($category->child()->get() as $category1)
                                                                        <option value={{$category1->id}}>{{$category1->name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Outlet</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <select  id="outlet" required data-validation-required-message="Outlet field is required" multiple="multiple" name="outlet[]" class="form-control select2">
                                                        {{--<option @if(isset($products->vendor_id) && $products->vendor_id == $vendor->id) selected @endif value="{{$vendor->id}}" >{{$vendor->name}}</option>--}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Tags</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <select  id="tags"  name="tag[]" multiple="multiple" class="form-control select2">
                                                        @foreach($tags as $tag)
                                                            <option value="{{$tag->id}}" >{{$tag->keyword}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Brand</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" name="brand_id">
                                                        @foreach($brands as $brand)
                                                            <option value="{{$brand->id}}" @if(isset($products) && $products->brand_id == $brand->id) selected  @endif >{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Feature Image</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input autocomplete="off" type="file" id="thumbnail" class="form-control" name="thumbnail" >
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Delivery</h3>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Instant Delivery</span>
                                                </div>
                                                <div class="col-md-2 controls">
                                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                                        <input type="checkbox" name="instant_delivery" @if(isset($products) && $products->instant_delivery==1) checked @endif class="custom-control-input"  id="switch-instant-delivery">
                                                        <label class="custom-control-label" for="switch-instant-delivery">
                                                            <span class="switch-text-left">Yes</span>
                                                            <span class="switch-text-right">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <span>National Delivery</span>
                                                </div>
                                                <div class="col-md-2 controls">
                                                    <div class="custom-control custom-switch switch-lg custom-switch-success">
                                                        <input type="checkbox" name="national_delivery" @if(isset($products) && $products->national_delivery==1) checked @endif class="custom-control-input"  id="switch-national-delivery">
                                                        <label class="custom-control-label" for="switch-national-delivery">
                                                            <span class="switch-text-left">Yes</span>
                                                            <span class="switch-text-right">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 instant">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Instant Base Price</span>
                                                </div>
                                                <div class="col-md-8 controls ">
                                                    <input autocomplete="off"  type="text"  id="shipping_instant_base"  class="form-control" @if(isset($products)) value="{{$products->shipping_instant_base}}" @endif name="shipping_instant_base" placeholder="Enter Shipping Instant Base Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 instant">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Additional Instant Price</span>
                                                </div>
                                                <div class="col-md-8 controls ">
                                                    <input autocomplete="off"  type="text"  id="shipping_instant_additional"  class="form-control" @if(isset($products)) value="{{$products->shipping_instant_additional}}" @endif name="shipping_instant_additional" placeholder="Enter Shipping Instant Additional Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Local Base Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text"  id="shipping_local_base"  class="form-control" @if(isset($products)) value="{{$products->shipping_local_base}}" @endif name="shipping_local_base" placeholder="Enter Shipping Local Base Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Additional Local Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text"  id="shipping_local_additional" class="form-control" @if(isset($products)) value="{{$products->shipping_local_additional}}" @endif name="shipping_local_additional" placeholder="Enter Shipping Local Additional Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>National Base Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text"  id="shipping_national_base" class="form-control" @if(isset($products)) value="{{$products->shipping_national_base}}" @endif name="shipping_national_base" placeholder="Enter Shipping National Price Enter Shipping National Additional Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Additional National Price</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input autocomplete="off" type="text"  id="shipping_national_additional" class="form-control" @if(isset($products)) value="{{$products->shipping_national_additional}}" @endif name="shipping_national_additional" placeholder="Enter Shipping National Additional Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-save"></i> Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <div class="row">
                                <div class="col-12">
                                    <h3>Product Images</h3>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-12">
                                    <button id="AddNewUploads" class="btn btn-primary btn-sm"><span class="fa fa-plus-circle"></span> Add New</button>
                                </div>
                                <div class="col-12">
                                    <form action="{{url('/dashboard/vendor/product/upload_files')}}" id="fm_dropzone_main" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input name="product_id" type="hidden" @if(isset($products)) value="{{$products->id}}" @else value="" @endif>
                                        <input name="vendor_id" type="hidden" @if(isset($products)) value="{{$products->vendor_id}}" @else value="" @endif>
                                        <a id="closeDZ1"><i class="fa fa-times"></i></a>
                                        <div class="dz-message"><i class="fa fa-cloud-upload"></i><br>Drop Images here to upload</div>
                                    </form>
                                </div>

                                <div class="box box-success col-12" style="overflow:auto; height:200px;"  >
                                    <!--<div class="box-header"></div>-->
                                    <div class="box-body" >
                                        <ul class="files_container">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var fm_dropzone_main = null;
        var cntFiles = null;

        $(function () {

            fm_dropzone_main = new Dropzone("#fm_dropzone_main", {
                maxFilesize: 2,
                acceptedFiles: "image/*",
                init: function() {
                    this.on("complete", function(file) {
                        this.removeFile(file);
                    });
                    this.on("success", function(file) {
                        loadUploadedFiles();
                    });

                }
            });


            $("#fm_dropzone_main").hide();
            $("#AddNewUploads").on("click", function() {
                if($('input[name="product_id"]').val()==="")
                {
                    $("#fm_dropzone_main").hide();
                    toastr.error('Please Save the Product');
                }
                else
                    $("#fm_dropzone_main").slideDown();
            });
            $("#closeDZ1").on("click", function() {
                $("#fm_dropzone_main").slideUp();
            });
            loadUploadedFiles();
            $("body").on("click", "ul.files_container .fm_file_sel span", function() {
                var upload = $(this).closest('a').attr("upload");
                upload = JSON.parse(upload);
                var url = "/dashboard/vendor/product/images/delete/"+upload.id;
                $.ajax({
                    dataType: 'json',
                    url: url,
                    method: 'get',
                    success: function ( response ) {
                        loadUploadedFiles();
                        toastr.success(response.message)

                    }
                });

            });

            @if(!empty(json_encode($productCategory)))
            var categoryArray = @json($productCategory);
            $.each(categoryArray,function (key,value) {

                $.each($('#category').find('option'),function () {
                    if($(this).val()===value)
                        $(this).attr('selected','selected');
                });
            });
            @endif

            @if(!empty(json_encode($productTag)))
            var tagArray = @json($productTag);
            $.each(tagArray,function (key,value) {
                $.each($('#tag').find('option'),function () {
                    if($(this).val()===value)
                        $(this).attr('selected','selected');
                });
            });
            @endif

            @if(Auth::user()->hasPrivilege('manage-multiple-vendor-product'))
            setOutlet($('input[name="vendor_id"]').val());
            @else
            setOutlet({{Auth::user()->vendor_id}})
            @endif

        });

        function loadUploadedFiles() {
            // load folder files
            var product_id = $('input[name="product_id"]').val();
            url = "{{ url('/dashboard/vendor/product/uploaded_files/') }}"+"/"+product_id;
            $.ajax({
                dataType: 'json',
                url: url,
                success: function ( json ) {

                    cntFiles = json.uploads;
                    $("ul.files_container").empty();
                    if(cntFiles.length) {
                        for (var index = 0; index < 16; index++) {
                            var element = cntFiles[index];
                            var li = formatFile(element,"");
                            $("ul.files_container").append(li);
                        }
                        for(var index = 16; index < cntFiles.length; index++)
                        {
                            var element = cntFiles[index];
                            var li = formatFile(element,"data-");
                            $("ul.files_container").append(li);
                        }
                    } else {
                        $("ul.files_container").html("<div class='text-center text-danger' style='margin-top:40px;'>No Files</div>");
                    }
                    //setLazyLoad();
                }
            });
        }

        function formatFile(upload,data) {

            var image = '';
            if($.inArray(upload.extension, ["jpg", "jpeg", "png", "gif", "bmp"]) > -1) {
                image = '<img  '+data+'src="'+upload.url+'?s=130">';
            } else {
                switch (upload.extension) {
                    case "pdf":
                        image = '<i class="fa fa-file-pdf-o"></i>';
                        break;
                    default:
                        image = '<i class="fa fa-file-text-o"></i>';
                        break;
                }
            }
            return '<li ><a class="fm_file_sel" style="position: relative;"  data-toggle="tooltip" data-placement="top"  upload=\''+JSON.stringify(upload)+'\'>'+image+'<span class="badge badge-pill badge-danger badge-up" style="top: 0px !important;right: 0px !important; position: absolute;">x</span></a></li>';
        }
        function setOutlet(vendor_id)
        {
            var options = null;
            $.ajax({
                url:'/dashboard/vendor/total-outlet/'+vendor_id,
                method:'get',
                dataType: 'json',
                success:function (response) {
                    var options = response.map((function (outlet) {
                        var option = document.createElement('option');
                        option.value = outlet.id;
                        option.textContent = outlet.name;
                        return option;

                    }));
                    $('#outlet').append(options)
                },
                complete:function () {
                        @if(!empty(json_encode($productOutlet)))
                        var outletArray = @json($productOutlet);
                        $.each(outletArray,function (key,value) {
                            $.each($('#outlet').find('option'),function () {
                                if($(this).val()===value)
                                    $(this).attr('selected','selected');
                            });
                        });
                        @endif
                }
            });

            return options;
        }


    </script>

    @endsection
