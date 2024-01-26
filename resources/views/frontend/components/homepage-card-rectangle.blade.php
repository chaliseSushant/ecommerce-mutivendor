<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
    <section class="col-12 card-container homepage-fullwidth bg-white">
        <div class="row">
            <div class="col-8 card-title">
                <h5>{{$data['title']}}</h5>
            </div>
            @if($data['url'] != null)
            <div class="col-4 text-right btn-expand">
                <a class="small text-warning" href="{{url($data['url'])}}">See more</a>
            </div>
            @endif
            <div class="col-12">
                <hr class="card-title-border-bottom">
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach($data['cards'] as $card)
                    @include('frontend.components.grid-2')
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
</div>
