<section class="col-12 address-wrap">
    <section class="row">
        <input class="col-1" type="radio" name="address" value="{{$address->id}}" @if($address->default) checked @endif>
        <label class="col-11" for="male"><strong>{{$address->name}}</strong> - <i>{{$address->phone}}</i>,
            {{$address->address_01}} {{$address->address_02}}, {{$address->district->name}}, {{$address->district->province->name}}
            <span class="delivery-address-action">
                 <a href="#" title="Edit"><i class="fa fa-pencil"></i></a>
                 <a href="#" title="Delete"><i class="fa fa-trash"></i></a>
            </span>
        </label>


    </section>
</section>
