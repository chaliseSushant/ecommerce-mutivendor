<section class="col-lg-5 col-sm-12">
    <div class="lightSlider-wrapper">
        <ul id="lightSlider">
            @foreach($product->images as $image)
                <li data-thumb="{{url($image->url)}}">
                    <img src="{{url($image->url)}}"/>
                </li>
            @endforeach
        </ul>
    </div>
</section>
