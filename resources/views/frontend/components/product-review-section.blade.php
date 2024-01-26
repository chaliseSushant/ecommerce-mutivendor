<section class="col-lg-8 col-md-8 col-sm-12 col-xs-12 rating-section mt-5{{-- border-right--}}">
    <section class="row">
        <h6 class="col-12 section-title">Reviews</h6>
        <div class="col-12 rating">
            <div id="dataReadonlyReviewAverage"></div>
        </div>


        @if(Auth::check())
            @if(Auth::user()->hasRole('customer'))

                @if($product->myReview() != null )
                    @include('frontend.components.product-review-single',['isMyReview'=>true])
                    <script>
                        $(function () {
                            $('#edit-review').on('click',function () {

                                $('.my-review').html("");
                                $('.my-review').html('<div class="col-12 review">'
                                    +'<form method="post" action="review/saveUpdate"> @csrf <input name="id" type="hidden"/><div class="row"><div class="col-12"><span><img class="user-icon icon-circle" src="{{url('frontend/images/user-dummy-pic.png')}}"></span>'
                                    +'<span class="review-user-name">Your Name Here</span></div><div class="col-12 user-rating-single">'
                                    +'<div id="halfstarsReview"></div><input id="halfstarsInput" name="rating" type="hidden"/></div>'
                                    +'<div class="col-12 review-text"><textarea rows="3" name="review" placeholder="Review this product"></textarea></div>'
                                    +'<div class="col-12 text-right"><button type="button" id="cancenBtn" class="btn-submit-review btn btn-secondary">Cancel</button> <button type="submit" class="btn-submit-review btn btn-warning">Submit</button></div></div></form></div>');
                                $('.my-review .review').find('.review-user-name').text('{{$product->myReview()->customer->user->name}}');
                                $('.my-review .review').find('input[name="id"]').val('{{$product->myReview()->id}}');
                                $('.my-review .review').find('textarea').text('{{$product->myReview()->review}}');
                                $('.my-review .review').find('#cancenBtn').on('click',function () {
                                    location.reload();
                                    return false;
                                });
                                $("#halfstarsReview").rating({
                                    "half": true,
                                    "value":'{{$product->myReview()->rating}}',
                                    "click": function (e) {
                                        $("#halfstarsInput").val(e.stars);
                                    }
                                });
                            })
                        })
                    </script>
                    @php $show_review_count = 1 @endphp
                @else
                    @php $show_review_count = 2 @endphp
                    @include('frontend.components.product-review-form')
                @endif
            @else
                @php $show_review_count = 2 @endphp
            @endif
        @else
            @php $show_review_count = 2 @endphp
        @endif
        @if($product->reviewDetailsCount() >= 1)
            <section class="col-12 review-group">
                <section class="row">
                    @php $i = 0; @endphp
                    @foreach($product->reviewDetails() as $singleReview)
                        @php $i++; @endphp
                        @if($i > $show_review_count)
                            <section class="col-12 text-center more-link">
                                <a href="#" data-toggle="modal" data-target="#product-reviews">View More</a>
                            </section>
                            @break
                        @endif
                        <div class="col-12 review">
                            <div class="row">
                                <div class="col-12">
                                    <span><img class="user-icon icon-circle" src="" onerror="this.onerror=null; this.src='{{url("frontend/images/user-dummy-pic.png")}}'"></span>
                                    <span class="review-user-name">{{$singleReview->customer->user->name}}</span>
                                </div>
                                <div class="col-12 user-rating-single ">
                                    <div data-rating-stars="5" data-rating-readonly="true" data-rating-value="{{$singleReview->rating}}"></div>
                                </div>
                                <div class="col-12 rating-date">
                                    <span>{{$singleReview->updated_at->diffForHumans()}}</span>
                                </div>
                                <div class="col-12 review-text">
                                    <p>Reviewed {{$singleReview->review}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </section>
            </section>

    @else
        No reviews
    @endif
    </section>
</section>
<script>
    $(function () {
        $("#dataReadonlyReviewAverage").rating({
            "half": true,
            "readonly":true,
            "value":"{{$product->ratingAverage()}}"
        });

    })



</script>
