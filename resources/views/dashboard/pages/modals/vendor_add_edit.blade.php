@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Please Fill up the vendor information</h3>

                    </div>
                    <hr/>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" novalidate method="post" action="/dashboard/vendor/saveUpdate" enctype="multipart/form-data">
                                @csrf
                                <input name="id" type="hidden" @if(isset($vendors)) value="{{$vendors->id}} @endif">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Name</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input type="text" id="name" required data-validation-required-message="Name field is required" @if(isset($vendors)) value="{{$vendors->name}}" @endif class="form-control" name="name" placeholder="Enter Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Phone Number</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input type="text" id="phone" required data-validation-required-message="Phone Number field is required" @if(isset($vendors)) value="{{$vendors->phone}}" @endif class="form-control" name="phone" placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Alt Phone No.</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input type="text" id="alt_phone"  @if(isset($vendors)) value="{{$vendors->alt_phone}}" @endif class="form-control" name="alt_phone" placeholder="Enter Alternate phone number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Email</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <input type="text" id="email" required data-validation-required-message="Email field is required" @if(isset($vendors)) value="{{$vendors->email}}" @endif class="form-control" name="email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Address</span>
                                                </div>
                                                <div class="col-md-8 controls">
                                                    <textarea type="text" id="address" rows="3"  required data-validation-required-message="Address field is required" class="form-control" name="address" placeholder="Enter Address">@if(isset($vendors)) {{$vendors->address}} @endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Vendor Type</span>
                                                </div>
                                                <div class="col-md-4 controls">
                                                    <select name="vendor_type" id="vendor_type" class="form-control select2">
                                                        @foreach($vendor_types as $vendor_type)
                                                            <option value="{{ $vendor_type->id }}">{{ $vendor_type->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Cover Image</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" id="cover" class="form-control" name="cover" >
                                                </div>
                                                @if(isset($vendors->cover))
                                                <div class="col-md-4">
                                                    <img src="{{$vendors->cover}}" style="height: 130px; width:130px;">
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>Icon Image</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" id="icon" class="form-control" name="icon" >
                                                </div>
                                                @if(isset($vendors->icon))
                                                    <div class="col-md-4">
                                                        <img src="{{$vendors->icon}}" style="height: 130px; width:130px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            @if(isset($vendors->id))
                                                <a href="{{url('/dashboard/vendor/delete')."/".$vendors->id}}" title="Delete Vendor" class="delete-vendor btn btn-danger mr-1 mb-1 waves-effect waves-light float-right delete-confirm" ><i class="feather icon-trash"></i> Delete Vendor</a>
                                            @endif
                                                <button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light float-right"><i class="feather icon-save"></i> Save</button>


                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <div class="row">
                                <div class="col-12">
                                    <h3>Upload Required Documents Here</h3>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-12">
                                    <button id="AddNewUploads" class="btn btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add New</button>
                                </div>
                                <div class="col-12">
                                    <form action="{{url('/dashboard/vendor/docs/upload_files')}}" id="fm_dropzone_main" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input name="vendor_id" type="hidden" @if(isset($vendors)) value="{{$vendors->id}}" @else value="" @endif>
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

                if($('input[name="vendor_id"]').val()==="")
                {
                    $("#fm_dropzone_main").hide();
                    toastr.error('Please Save the Vendor');
                }
                else
                    $("#fm_dropzone_main").slideDown();
            });
            $("#closeDZ1").on("click", function() {
                $("#fm_dropzone_main").slideUp();
            });
            loadUploadedFiles();
            $("body").on("click", "ul.files_container .fm_file_sel .badge-danger", function() {
                var upload = $(this).closest('a').attr("upload");
                upload = JSON.parse(upload);
                var url = "/dashboard/vendor/docs/delete/"+upload.id;
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

            $("body").on('click','ul.files_container .fm_file_sel .badge-primary i',function(){

                var upload = $(this).closest('a').attr("upload");
                upload = JSON.parse(upload);
                var url = upload.url;
                window.open(url,"_blank");

            });



        });
        function loadUploadedFiles() {
            // load folder files
            var vendor_id = $('input[name="vendor_id"]').val();
            url = "{{ url('/dashboard/vendor/docs/uploaded_files/') }}"+"/"+vendor_id;
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
                        $("ul.files_container").html("<div class='text-center text-danger' style='margin-top:40px;'>No Documents Uploaded !</div>");
                    }
                    //setLazyLoad();
                }
            });
        }
        function formatFile(upload,data) {
            var image = '<img  '+data+'src="'+upload.url+'?s=130">';
            return '<li ><a   class="fm_file_sel" style="position: relative;" upload=\''+JSON.stringify(upload)+'\'  data-toggle="tooltip" data-placement="top"\>'+image+'<span class="badge badge-pill badge-danger badge-up" style="top: 0px !important;right: 0px !important; position: absolute;"><i class="feather icon-trash"><i/></span><span class="badge badge-pill badge-primary badge-up" style="top: 23px !important;right: 0px !important; position: absolute;"><i class="feather icon-eye"><i/></span></a></li>';
        }

    </script>
    @endsection


