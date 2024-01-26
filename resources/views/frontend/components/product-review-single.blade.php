<div class="col-12 review @if(isset($isMyReview)) my-review @endif">
    <div class="row">
        <div class="col-12 @if(isset($isMyReview)) my-review @endif">
            <span><img class="user-icon icon-circle" src="{{url('frontend/images/user-dummy-pic.png')}}"></span>
            @php
                /*dd($isMyReview)*/
            @endphp
            <span class="review-user-name">@if(isset($isMyReview)){{$product->myReview()->customer->user->name}} @else {{$reviewDetail->customer->user->name}}@endif</span>
            @if(isset($isMyReview))
                <span class="float-right review-option">
                    <span style="cursor:pointer" id="edit-review"  title="Edit"><i class="fa fa-pencil"></i></span>
                    <a href="{{url('product/review/delete')."/".$product->myReview()->id}}" title="Delete"><i class="fa fa-trash"></i></a>
                </span>
            @endif
        </div>
        <div class="col-12 user-rating-single ">
            <div data-rating-stars="5" data-rating-readonly="true" data-rating-half="true"  data-rating-value="@if(isset($isMyReview)){{$product->myReview()->rating}}@else{{$reviewDetail->rating}}@endif"></div>
        </div>
        <div class="col-12 rating-date">
            <span>@if(isset($isMyReview)){{$product->myReview()->updated_at->diffForHumans()}}@else{{$reviewDetail->updated_at->diffForHumans()}}@endif</span>
        </div>
        <div class="col-12 review-text">
            <p>@if(isset($isMyReview)){{$product->myReview()->review}}@else{{$reviewDetail->review}}@endif</p>
        </div>
    </div>
</div>


