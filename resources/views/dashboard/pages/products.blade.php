@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a @if(isset($vendor)) href="{{url('/dashboard/product/add_edit/'.$vendor->id)}}" @else href="{{url('/dashboard/vendor/product/add_edit')}}" @endif class="btn btn-primary" >Add New Product</a>
                        <div class="text-right">
                            <strong>@if(isset($vendor->name)) {{$vendor->name}} @endif</strong>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->sku}}</td>
                                            <td>{{$product->name}}</td>
                                            <td><div class="avatar mr-1 avatar-xl avatar-square">
                                                    <img src="@if($product->thumbnail != null){{url($product->thumbnail)}} @endif" onerror="this.onerror=null; this.src='{{url("frontend/images/product.jpg")}}'" alt="avtar img holder">
                                                </div></td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->brand->name}}</td>
                                            <td><div class="custom-control custom-switch switch-lg custom-switch-success">
                                                    <input type="checkbox" @if($product->status==1) checked @endif value="{{$product->id}}" class="custom-control-input status" id="switch-{{$product->id}}">
                                                    <label class="custom-control-label" for="switch-{{$product->id}}">
                                                        <span class="switch-text-left">Active</span>
                                                        <span class="switch-text-right">Inactive</span>
                                                    </label>
                                                </div></td>
                                            <td class="product-action">
                                                <a href="/dashboard/vendor/products/specification_values/{{$product->id}}" rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Product Specification"><i class="feather icon-layers success"></i></a>
                                                <a href="/dashboard/vendor/product/add_edit/{{$product->id}}"><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="/dashboard/vendor/product/delete/{{$product->id}}"><i class="feather icon-trash danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    $('.status').on('change',function () {
        var value = $(this).val();
        if($(this).is(':checked') === false)
        {
            var url = "{{url('/dashboard/store/product/status/')."/"}}"+value+"/"+0;
        }
        else
            var url = "{{url('/dashboard/store/product/status/')."/"}}"+value+"/"+1;
        $.ajax({
            url:url,
            method:'get',
            success:function (response) {
                if(response.type ==="update")
                    toastr.success(response.message);
                else
                    toastr.error(response.message);
            }
        });
    });
</script>
@endsection
