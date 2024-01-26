<!-- Modal -->
<div class="modal fade" id="product-reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content reviews">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(Auth::check())
                    @if(Auth::user()->hasRole('customer'))
                        @if($product->myReview() != null )
                            @include('frontend.components.product-review-single',['isMyReview'=>true])
                        @else
                            @include('frontend.components.product-review-form')
                        @endif
                    @endif
                @endif
                @if($product->reviewDetailsCount() >= 1)
                    @foreach($product->reviewDetails() as $reviewDetail)
                        @include('frontend.components.product-review-single')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<script>

</script>
