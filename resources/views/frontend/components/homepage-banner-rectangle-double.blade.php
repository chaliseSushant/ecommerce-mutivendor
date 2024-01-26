<section class="col-lg-8 col-md-8 col-sm-12 col-xs-12 banner-container">
    <a href="{{url($data['cards'][0]['url'])}}">
        <img class="thumb" @if($data['cards'][0]['image'] != null) src="{{url($data['cards'][0]['image'])}}" @else src="" @endif onerror="this.onerror=null; this.src='{{url("/frontend/images/rectangle-double.jpg")}}'">
    </a>
</section>

