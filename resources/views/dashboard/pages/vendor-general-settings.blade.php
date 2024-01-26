@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-bank-details" data-toggle="pill" href="#account-vertical-bank-details" aria-expanded="false">
                            <i class="feather icon-credit-card mr-50 font-medium-3"></i>
                            Bank Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-documents" data-toggle="pill" href="#account-vertical-documents" aria-expanded="false">
                            <i class="feather icon-folder mr-50 font-medium-3"></i>
                            Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            Change Password
                        </a>
                    </li>

                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                   <h4> General Details</h4>
                                    <hr>
                                    <form method="post" action="/dashboard/vendor/saveUpdate" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <input type="hidden" @if(isset($vendor_info)) value="{{$vendor_info->id}}" @endif name="id">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Name</label>
                                                        <input type="text" class="form-control" name="name" id="account-username" placeholder="Name" @if(isset($vendor_info)) value="{{$vendor_info->name}}" @endif required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone" id="account-phone_number" placeholder="Phone Number" @if(isset($vendor_info)) value="{{$vendor_info->phone}}" @endif required data-validation-required-message="This phone number field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Alternate Phone Number</label>
                                                        <input type="text" class="form-control" name="alt_phone" id="account-alt_phone_number" placeholder="Alternate Phone Number" @if(isset($vendor_info)) value="{{$vendor_info->alt_phone}}" @endif >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Address</label>
                                                        <textarea type="text" class="form-control" name="address" id="account-address" placeholder="Address" required data-validation-required-message="This address field is required">@if(isset($vendor_info)) {{$vendor_info->address}} @endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-e-mail">E-mail</label>
                                                        <input type="email" class="form-control" name="email" id="account-e-mail" placeholder="Email" @if(isset($vendor_info)) value="{{$vendor_info->email}}" @endif required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Cover Image</label>
                                                        <input type="file" class="form-control" id="account-cover" name="cover">
                                                        @if(isset($vendor_info->cover))
                                                        <img src="{{$vendor_info->cover}}" style="width:130px; height:130px; object-fit:cover; margin-top:5px">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Icon Image</label>
                                                        <input type="file" class="form-control" id="account-icon" name="icon">
                                                        @if(isset($vendor_info->icon))
                                                        <img src="{{$vendor_info->icon}}" style="width:130px; height:130px; object-fit:cover; margin-top:5px">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="account-vertical-bank-details" role="tabpanel" aria-labelledby="account-pill-bank-details" aria-expanded="false">
                                    <form method="post" action="{{url('/dashboard/vendor/bank_details/update')}}" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Account Name</label>
                                                        <input type="text" name="account_name" class="form-control" id="account-name" placeholder="Account Name" @if(isset($bank_details)) value="{{$bank_details->account_name}}" @endif required data-validation-required-message="This account name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Account Number</label>
                                                        <input type="text" name="account_number" class="form-control" id="account-number" placeholder="Account Number" @if(isset($bank_details)) value="{{$bank_details->account_number}}" @endif required data-validation-required-message="This account number field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Bank Name</label>
                                                        <input type="text" name="bank_name" class="form-control" id="bank-name" placeholder="Bank Name" @if(isset($bank_details)) value="{{$bank_details->bank_name}}" @endif required data-validation-required-message="This bank name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">Branch</label>
                                                        <input type="text" name="branch" class="form-control" id="branch-name" placeholder="Branch" @if(isset($bank_details)) value="{{$bank_details->branch}}" @endif required data-validation-required-message="This branch field is required">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="account-vertical-documents" role="tabpanel" aria-labelledby="account-pill-documents" aria-expanded="false">
                                        <div class="row">
                                            <div class="col-12">
                                                <button id="AddNewUploads" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Add New</button>
                                            </div>
                                            <div class="col-12">
                                                <form action="{{url('/dashboard/vendor/docs/upload_files')}}" id="fm_dropzone_main" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    <input name="vendor_id" type="hidden" @if(isset($vendor_info)) value="{{$vendor_info->id}}" @else value="" @endif>
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


                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <form method="post" action="/dashboard/change-password/vendor" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">Current Password</label>
                                                        <input type="password" name="current_password" class="form-control" id="account-current-password" required placeholder="Current Password" data-validation-required-message="This current password field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">New Password</label>
                                                        <input type="password" name="new_password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Retype New
                                                            Password</label>
                                                        <input type="password" name="confirm_new_password" class="form-control" required id="account-retype-new-password" data-validation-match-match="new_password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
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
            $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('.nav-pills a[href="' + activeTab + '"]').tab('show');
            }

            fm_dropzone_main = new Dropzone("#fm_dropzone_main", {
                maxFilesize: 2,
                acceptedFiles: "image/*",
                init: function() {
                    this.on("complete", function(file) {
                        this.removeFile(file);
                    });
                    this.on("success", function(file) {
                        console.log("addedfile");
                        console.log(file);
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
            $("body").on("click", "ul.files_container .fm_file_sel span", function() {
                var upload = $(this).closest('a').attr("upload");
                upload = JSON.parse(upload);
                var url = "/dashboard/vendor/docs/delete/"+upload.vendor_id;
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
                    console.log(cntFiles);
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

    </script>
@endsection
