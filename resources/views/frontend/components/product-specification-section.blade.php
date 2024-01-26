<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 product-specifications mt-5">
    <div class="row">
        <h6 class="col-12 section-title">Specifications</h6>
        <div class="col-12">
            <div class="row">
                @foreach($product->specifications as $specification)
                    <div class="col-12 specification-col">
                        <div class="row">
                            <div class="col-4 sp-title">{{$specification->specification->name}}</div>
                            <div class="col-8 sp-value">{{$specification->value}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
