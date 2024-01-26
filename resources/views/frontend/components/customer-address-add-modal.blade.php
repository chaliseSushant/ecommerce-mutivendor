<!-- Modal -->

    <div class="modal-dialog" role="document">
        <div class="modal-content reviews">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add/Edit Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="col-12 address-form" method="post" action="{{url('/customer/addresses/add/')}}">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="name">Deliver To (Name)</label>
                            <input type="text" name="name" class="form-control form-control-sm" id="name-input" placeholder="Name">
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="phone-input" placeholder="xxx-xxx-xxxx">
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="province-selector">Province</label>
                            <select class="form-control form-control-sm province-selector" id="province-selector">
                                @php $provinces = App\Province::all()->sortBy('code') @endphp
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="district-selector">District</label>
                            <select name="district" class="form-control form-control-sm district-selector" id="district-selector">
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="address-line-1">Address - Line 1</label>
                            <input type="text" name="line1" class="form-control form-control-sm" id="line1-input" placeholder="ABC Tower, DEF Marga, GHI Tole">
                        </div>
                        <div class="form-group col-12">
                            <label for="address-line-1">Address - Line 2</label>
                            <input type="text" name="line2" class="form-control form-control-sm" id="line2-input" placeholder="County, City">
                        </div>
                        <div class="form-group col-12 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_default" class="custom-control-input" id="is_default" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Default Address</label>
                        </div>
                        <div class="form-group col-sm-6 button-group">
                            <button type="reset" class="btn btn-secondary form-control form-control-sm">Clear</button>
                        </div>
                        <div class="form-group col-sm-6 button-group">
                            <button type="submit" class="btn btn-warning form-control form-control-sm">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


