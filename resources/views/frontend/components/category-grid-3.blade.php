<section class="col-lg-4 col-md-6 col-sm-8 col-xs-12 product-grid-3">
 <div class="row">
     <a href="{{url($card['url'])}}">
         <div class="row">
             <div class="col-12 product-img-wrapper">
                 <img class="product-img" @if($card['image'] != null) src="{{url($card['image'])}}" @else src="" @endif  onerror="this.onerror=null; this.src='{{url("frontend/images/default_category_thumb.jpg")}}'">
             </div>
             <div class="col-12 product-info">
                 <div class="row">
                     <div class="col-12 title">
                         {{$card['title']}}
                     </div>
                 </div>
             </div>

         </div>
     </a>
 </div>
</section>
