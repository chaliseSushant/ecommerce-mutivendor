<section class="col-lg-3 col-md-6 col-sm-12 customer-address-card-wrapper">
    <section class="row customer-address-card @if($address->default == 1) default-address @endif">
        @if($address->default == 1)
        <section class="col-12 default-header">
            Default
        </section>
        @endif
        <section class="col-12 delivery-name">
            <strong>{{$address->name}}</strong> - <i>{{$address->phone}}</i>
        </section>
        <section class="col-12 full-address">
            <p>{{$address->address_01}},<br>{{$address->address_02}},<br>{{$address->district->name}},<br>{{$address->district->province->name}}</p>
        </section>
        <section class="col-12 actions">
            <span><a href="#"
                data-toggle="modal"
                data-target="#add-address"
                     data-id="{{$address->id}}"
                     data-name="{{$address->name}}"
                     data-phone="{{$address->phone}}"
                     data-district_id="{{$address->district_id}}"
                     data-province_id="{{$address->district->province->id}}"
                     data-address_01="{{$address->address_01}}"
                     data-address_02="{{$address->address_02}}"
                     data-default="{{$address->default}}"
                     data-type="update"
                >Edit</a>
            </span><span>|</span><span><a href="{{url('/customer/addresses/delete_address/'.$address->id)}}">Delete</a></span>@if($address->default == 0)<span>|</span><span><a href="{{url('/customer/addresses/set_default_address/'.$address->id)}}">Set as Default</a></span>@endif
        </section>
    </section>
</section>

