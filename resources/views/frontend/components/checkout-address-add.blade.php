<section class="col-12 section-title">
    Or add a new address
</section>
<form class="col-12 address-form" method="post" action="{{"/cart/checkout/updateAddress/".$cart->id}}">
    @csrf
    <div class="row">
        <div class="form-group col-lg-6 col-sm-12">
            <label for="name">Deliver To (Name)</label>
            <input type="text" name="name" class="form-control form-control-sm" id="name-input" placeholder="Rajan Shrestha">
        </div>
        <div class="form-group col-lg-6 col-sm-12">
            <label for="name">Phone</label>
            <input type="text" name="phone" class="form-control form-control-sm" id="phone-input" placeholder="xxx-xxx-xxxx">
        </div>
        <div class="form-group col-lg-6 col-sm-12">
            <label for="province-selector">Province</label>
            <select class="form-control form-control-sm" id="province-selector">
                @php $provinces = App\Province::all()->sortBy('code') @endphp
                @foreach($provinces as $province)
                    <option value="{{$province->id}}">{{$province->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-6 col-sm-12">
            <label for="district-selector">District</label>
            <select name="district" class="form-control form-control-sm" id="district-selector">
            </select>
        </div>
        <div class="form-group col-12">
            <label for="address-line-1">Address - Line 1</label>
            <input type="text" name="line1" class="form-control form-control-sm" id="line1-input" placeholder="ABC Tower, DEF Marga, GHI Tole">
        </div>
        <div class="form-group col-12">
            <label for="address-line-1">Address - Line 2</label>
            <input type="text" name="line2" class="form-control form-control-sm" id="line2-input" placeholder="County, City">
        </div>
        <div class="form-group col-12 custom-control custom-checkbox ">
            <input type="checkbox" name="is_default" class="custom-control-input" id="customControlAutosizing">
            <label class="custom-control-label" for="customControlAutosizing">Default Address</label>
        </div>
        <div class="form-group col-sm-6 button-group">
            <button type="reset" class="btn btn-secondary form-control form-control-sm">Clear</button>
        </div>
        <div class="form-group col-sm-6 button-group">
            <button type="submit" class="btn btn-warning form-control form-control-sm">Add</button>
        </div>

    </div>
</form>
<script>
    $(function () {
        var province_id = $("#province-selector").val();
        loadDistrict(province_id);

        $("#province-selector").on('change',function () {
            var province_id = $("#province-selector").val();
            loadDistrict(province_id);
        });
    });
    function loadDistrict(province_id)
    {
        $.ajax({
            url:'/api/get_districts/'+province_id,
            type:'json',
            method:'get',
            success:function (response) {
                $('#district-selector').html("");
                $.each(response,function (index,value) {
                    var option = '<option value="'+value+'">'+index+'</option>';
                    $('#district-selector').append(option);

                })

            }
        });
    }
    /*$(document).ready(
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
        });*/
</script>
