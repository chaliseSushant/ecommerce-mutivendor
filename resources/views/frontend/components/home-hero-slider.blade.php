<div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndicators" data-slide-to="1"></li>
        <li data-target="#carouselIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach($slides as $slide)
            @if ($loop->first)
                <a href="{{url($slide->url)}}" class="carousel-item active">
                    <img class="d-block w-100" src="{{url($slide->image_url)}}">
                </a>
            @else
                <a href="{{url($slide->url)}}" class="carousel-item">
                    <img class="d-block w-100" src="{{url($slide->image_url)}}">
                </a>
            @endif
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<script>
    $('.carousel').carousel({
        interval: 5000
    })
</script>
