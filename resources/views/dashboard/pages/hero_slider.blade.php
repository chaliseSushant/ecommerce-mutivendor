@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <button id="AddNewUploads" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add New</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{url('/dashboard/hero_slider/upload_files')}}" id="fm_dropzone_main" enctype="multipart/form-data" method="POST">
                            @csrf
                            <a id="closeDZ1"><i class="fa fa-times"></i></a>
                            <div class="dz-message"><i class="fa fa-cloud-upload"></i><br>Drop files here to upload</div>
                        </form>

                        <div class="box box-success" style="overflow:auto; height:500px;"  >
                            <!--<div class="box-header"></div>-->
                            <div class="box-body" >
                                <ul class="files_container">

                                </ul>
                            </div>
                        </div>


                        <div class="modal fade text-left" id="EditFileModal" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:90%;">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>


                                    </div>
                                    <div class="modal-body">
                                        <div class="row m0">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="fileObject">

                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <form class="file-info-form">
                                                    @csrf
                                                    <input type="hidden" name="id">
                                                    <div class="form-group">
                                                        <label for="filename">URL</label>
                                                        <input class="form-control" placeholder="Target Url" name="url" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="url">Is Active</label>

                                                        <fieldset>
                                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                                <input type="checkbox" name="active" checked="">
                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                </form>
                                            </div>
                                        </div><!--.row-->
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-success" id="updateBtn">Update</button>
                                        <button type="button" class="btn btn-danger" id="delFileBtn">Delete</button>

                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
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
        //var bsurl = '{{url('')}}';
        var fm_dropzone_main = null;
        var cntFiles = null;
        $(function () {

            fm_dropzone_main = new Dropzone("#fm_dropzone_main", {
                maxFilesize: 2,
                acceptedFiles: "image/*,application/pdf",
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
                $("#fm_dropzone_main").slideDown();
            });
            $("#closeDZ1").on("click", function() {
                $("#fm_dropzone_main").slideUp();
            });

            $("body").on("click", "ul.files_container .fm_file_sel", function() {

                var upload = $(this).attr("upload");
                upload = JSON.parse(upload);

                //$("#EditFileModal .modal-title").html("File: "+upload.name);
                $(".file-info-form input[name=url]").val(upload.url);
                $(".file-info-form input[name=id]").val(upload.id);
                if(upload.active === 1)
                    $(".file-info-form input[name=active]").attr('checked','true');
                $("#EditFileModal #downFileBtn").attr("href", upload.name+"?download");




                $("#EditFileModal .fileObject").empty();
                if($.inArray(upload.extension, ["jpg", "jpeg", "png", "gif", "bmp"]) > -1) {
                    $("#EditFileModal .fileObject").append('<img src="'+upload.image_url+'">');
                    $("#EditFileModal .fileObject").css("padding", "15px 0px");
                } else {
                    switch (upload.extension) {
                        case "pdf":
                            // TODO: Object PDF
                            $("#EditFileModal .fileObject").append('<object width="100%" height="325" data="'+bsurl+''+'/'+upload.name+'"></object>');
                            $("#EditFileModal .fileObject").css("padding", "0px");
                            break;
                        default:
                            $("#EditFileModal .fileObject").append('<i class="fa fa-file-text-o"></i>');
                            $("#EditFileModal .fileObject").css("padding", "15px 0px");
                            break;
                    }
                }
                $("#EditFileModal").modal('show');
            });





            $("#EditFileModal #updateBtn").on("click", function() {
                // TODO: Change Filename
                $.ajax({
                    url: "{{ url('/dashboard/hero_slider/uploads_update') }}",
                    method: 'POST',
                    data: $("form.file-info-form").serialize(),
                    success: function( data ) {
                        loadUploadedFiles();
                        $("#EditFileModal").modal('hide');
                    }
                });
            });


            $("#EditFileModal #delFileBtn").on("click", function() {

                if(confirm("Delete slider image ?")) {
                    $.ajax({
                        url: "{{ url('/dashboard/hero_slider/uploads_delete_file') }}",
                        method: 'POST',
                        data: $("form.file-info-form").serialize(),
                        success: function( data ) {

                            loadUploadedFiles();
                            $("#EditFileModal").modal('hide');
                            //setLazyLoad();
                        }
                    });
                }
            });

            loadUploadedFiles();
        });
        function loadUploadedFiles() {
            // load folder files
            $.ajax({
                dataType: 'json',
                url: "{{ url('/dashboard/hero_slider/uploaded_files') }}",
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
                image = '<img  '+data+'src="'+upload.image_url+'?s=130">';
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
            return '<li ><a class="fm_file_sel" data-toggle="tooltip" data-placement="top" title="'+upload.name+'" upload=\''+JSON.stringify(upload)+'\'>'+image+'</a></li>';
        }
    </script>
@endsection
