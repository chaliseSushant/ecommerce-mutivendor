<!-- Modal -->
<div class="modal fade" id="update-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-12 address-form" method="post" action="{{url('/customer/profile/update/')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{Auth::user()->name}}" id="name-input">
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" @if(Auth::user()->customer->gender== 1) checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" @if(Auth::user()->customer->gender== 2) checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="3" @if(Auth::user()->customer->gender== 3) checked @endif>
                                <label class="form-check-label" for="inlineRadio3">Other</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-sm" value="{{Auth::user()->customer->phone}}" id="phone-input">
                        </div>
                        <div class="form-group col-sm-12 button-group">
                            <button type="submit" class="btn btn-warning form-control form-control-sm">Update Profile</button>
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
