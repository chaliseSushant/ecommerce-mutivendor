<div class="col-12 review">
    <form method="post" action="review/saveUpdate">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
    <div class="row">
        <div class="col-12">
            <span><img class="user-icon icon-circle" src="{{url('frontend/images/user-dummy-pic.png')}}"></span>
            <span class="review-user-name"></span>
        </div>

            <div class="col-12 user-rating-single">
                <div id="halfstarsSingleReview"></div>
                <input id="halfstarsSingleInput" name="rating" type="hidden"/>
            </div>
            <div class="col-12 review-text">
                <textarea placeholder="Review this product" name="review"></textarea>
            </div>
            <div class="col-12 text-right">
                <button type="button" class="btn-submit-review btn btn-secondary">Cancel</button>
                <button type="submit" class="btn-submit-review btn btn-warning">Submit</button>
            </div>


    </div>
    </form>
</div>
<script>
    $(function () {
        $("#halfstarsSingleReview").rating({
            "half": true,
            "click": function (e) {
                $("#halfstarsSingleInput").val(e.stars);
            }
        });
    })
</script>
