@extends('frontend.layouts.app')
@section('content')
    <div class="jumbotron-fluid cover customer-header">
        <h3>{{explode(' ',auth::user()->name)[0]}}'s Addresses</h3>
    </div>
<div class="page-wrapper offwhite">
    <div class="container">
        <div class="row">
            <section class="col-12 body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <section class="col-12 address-card-section-wrapper">
                                <section class="row address-card-section">
                                    <section class="col-lg-3 col-md-6 col-sm-12 customer-address-card-wrapper">
                                        <a href="#" data-toggle="modal" data-target="#add-address" class="row customer-address-card-add">
                                            <i class="col-12 fa fa-plus-circle"></i><br>
                                            <p class="col-12">Add address</p>
                                        </a>
                                    </section>
                                    {{--Addresses Card Loops--}}
                                    @foreach($addresses as $address)
                                        @include('frontend.components.customer-address-cards')
                                    @endforeach
                                    {{--Addresses Card Loops--}}
                                </section>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="add-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('frontend.components.customer-address-add-modal')
</div>

<script>
    $(function () {

        $('#add-address').on('shown.bs.modal',function (e) {

            var modal = $(this);
            modal.find('button[type="reset"]').click();
            var link =  $(e.relatedTarget);
            var type = link.data('type');
            if(type==="update")
            {
                var id = link.data('id');
                var name = link.data('name');
                var phone = link.data('phone');
                var province_id = link.data('province_id');
                var district_id = link.data('district_id');
                var address_01 = link.data('address_01');
                var address_02 = link.data('address_02');
                var is_default = link.data('default');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name-input').val(name);
                modal.find('.modal-body #phone-input').val(phone);
                modal.find('.modal-body #province-selector').val(province_id);
                loadDistrict(province_id,district_id);

                modal.find('.modal-body #line1-input').val(address_01);
                modal.find('.modal-body #line2-input').val(address_02);
                if(is_default ===1)
                    modal.find('.modal-body #is_default').attr('checked',true);
                else
                    modal.find('.modal-body #is_default').attr('checked',false);
            }
            else{
                var province_id = $('#province-selector').val();
                loadDistrict(province_id);
            }





        });


        $("#province-selector").on('change',function () {
            var province_id = $("#province-selector").val();
            loadDistrict(province_id);
        });

    })



    function loadDistrict(province_id,district_id)
    {
        district_id = district_id || 0;
        $.ajax({
            url:'/api/get_districts/'+province_id,
            type:'json',
            method:'get',
            success:function (response) {
                $('#district-selector').html("");
                $.each(response,function (index,value) {
                    if(value===district_id)
                        var option = '<option value="'+value+'" selected>'+index+'</option>';
                    else
                        var option = '<option value="'+value+'">'+index+'</option>';
                    $('#district-selector').append(option);

                })

            }
        });
    }
</script>
@endsection
