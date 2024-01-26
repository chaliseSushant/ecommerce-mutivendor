<!-- Modal -->
<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-12 address-form" method="post" action="{{url('/customer/password/change/')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">Old Password</label>
                            <input type="password" name="old_password" class="form-control form-control-sm" id="old-pw-input">
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">New Password</label>
                            <input type="password" name="passowrd" class="form-control form-control-sm" id="new-pw-input">
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">Confirm Password</label>
                            <input type="password" name="c_password" class="form-control form-control-sm" id="re-new-pw-input">
                        </div>
                        <div class="form-group col-sm-12 button-group">
                            <button type="submit" class="btn btn-warning form-control form-control-sm">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(
        function() {
            var root = location.protocol + '//' + location.host;
            $.ajax({
                url:root+'/api/get_provinces',
                type:'GET',
                success:function (result) {
                    $('#province-selector').empty();
                    var empty = new Option('Select Province',0).selected;
                    $("#province-selector").append(empty);
                    $.each(result, function(key, area){
                        var option = new Option(area['name'],area['id']);
                        $("#province-selector").append(option);
                    });
                },
                error: function () {
                    console.log('error');
                }
            })
        });
    $("#province-selector").change(
        function () {
            var root = location.protocol + '//' + location.host;
            $.ajax({
                url:root+'/api/get_districts',
                type:'POST',
                data: {
                    'province_id':$("#province-selector").val()
                },
                success:function (result) {
                    $('#district-selector').empty();
                    var empty = new Option('Select District',0).selected.disabled;
                    $("#district-selector").append(empty);
                    $.each(result, function(key, city){
                        var option = new Option(city['name'],city['id']);
                        $("#district-selector").append(option);
                    });
                },
                error: function () {
                    console.log('Could not load district');
                }
            })
        });
</script>
