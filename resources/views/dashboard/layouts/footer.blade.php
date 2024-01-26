

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2019<a class="text-bold-800 grey darken-2" href="https://innovations.prabidhee.com" target="_blank">Prabidhee Innovations,</a>All Rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
    </p>
</footer>
<!-- END: Footer-->

<!-- BEGIN: Page Vendor JS-->

<script src="{{url('dash/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/forms/select/select2.full.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{url('dash/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{url('dash/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{url('dash/app-assets/js/core/app.js')}}"></script>
<script src="{{url('dash/assets/js/moment.min.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/components.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/forms/number-input.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/tooltip/tooltip.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/toastr.min.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/extensions/drag-drop.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/extensions/sweetalert1.min.js')}}"></script>
<script src="{{url('dash/assets/js/datetimepicker.min.js')}}"></script>
<script src="{{url('dash/assets/js/datepicker-en.js')}}"></script>
<script src="{{url('dash/assets/js/daterangepicker.js')}}"></script>
<script src="{{url('dash/src/js/scripts/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('dash/src/js/scripts/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('dash/src/js/scripts/tinymce/plugins/code/plugin.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{url('dash/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>
<script src="{{url('dash/app-assets/js/scripts/ui/data-list-view.js')}}"></script>
<!-- END: Page JS-->
<script>
    @if(session()->has('messages'))
        @if(session()->get('messages')['type'] == "save" || session()->get('messages')['type'] == "update" || session()->get('messages')['type'] == "delete" )
            toastr.success('{{session()->get('messages')['message']}}');
        @elseif(session()->get('messages')['type'] == "error")
        toastr.error('{{session()->get('messages')['message']}}');
        @endif
    {{session()->forget('messages')}}

    @endif
    @if($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('{{$error}}');
        @endforeach
    @endif
    $(function () {
            var dataBaseTags=[];
            $('#dataTable').DataTable();
            $('.select2').select2();
            $(".toggle-password").click(function() {
                $(this).toggleClass("icon-eye icon-eye-off");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
            tinymce.init({ selector:'#editor',theme: "modern",height: 500,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor  code", "autoresize"
                ],
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "link unlink anchor | image media | forecolor backcolor  | print preview code ",});
            $('.delete-confirm').on('click', function (event) {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'This record will be deleted permanantly!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
                });
            });

            $.getJSON('{{url('/dashboard/tag/getTag')}}')
                .done(function(response) {
                    $.each(response, function(i, subject){
                        dataBaseTags.push({id: subject.id, text: subject.keyword});
                    })
                });
            $('#tags')
                .select2({
                    createTag: function(tag) {
                        return {
                            id: tag.term,
                            text: tag.term.toLowerCase(),
                            isNew : true
                        };
                    },

                    tags: true,
                    tokenSeparators: [',', '.']
                })
                .on("select2:select", function(e) {

                    if(addSubject(dataBaseTags, e.params.data.text)){
                       ajaxPost(e.params.data.text,'{{url('/dashboard/tag/create')}}');
                    }
                })
        });
    function ajaxPost(subject,url,type){

        var token = '{{ csrf_token() }}'
        $.ajax({
            type : "POST",
            url : url,

            data : {formData:subject,_token: token},
            success:function (response) {

                    $.each($('#tags').find('option'),function () {
                        if($(this).val()===response.name)
                            $(this).val(response.id);
                    });


            }
        })

    }

    function addSubject(subjects, input) {
        if (!input || input.length < 3) return false

        var allSubjects = [];

        $.each(subjects, function(i, subject){
            if(subject.text) allSubjects.push(subject.text)
        });

        if(allSubjects.includes(input)){
            return false
        }

        if(confirm("Are you sure you want to add this new subject " + input + "?")){
            return true
        }
        return false
    }
</script>

</body>
<!-- END: Body-->

</html>
