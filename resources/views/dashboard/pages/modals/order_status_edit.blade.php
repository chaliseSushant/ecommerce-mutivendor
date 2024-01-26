<div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">Edit Order Status</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form form-horizontal" method="post" action="{{url('/dashboard/store/order/edit')}}">

            @csrf
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group row">
                    <div class="col-md-4">
                        <span>Parent Menu</span>
                    </div>
                    <div class="col-md-8">
                        <select id="order_status_id" class="form-control" name="order_status_id">
                            @foreach($order_statuses as $order_status)
                                <option  value="{{$order_status->id}}">{{$order_status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Update</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>

    </div>
</div>

