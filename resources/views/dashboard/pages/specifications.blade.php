@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-content">
                            <div class="card-body">
                            <form action='/dashboard/product-specifications/saveUpdate' method="post">
                            @csrf
                            <input name="id" @if(isset($specs['spec_title'])) value="{{$specs['spec_title']->id}}"  @endif type="hidden"/>
                                <div class="row">
                                   <div class="col-4">
                                       <span>Specification Title</span>
                                       <input class="form-control" name="specification_title" placeholder="Spec Title" @if(isset($specs['spec_title'])) value="{{$specs['spec_title']->name}}"  @endif/>
                                   </div>
                                   <div class="col-6">
                                       <span>Category</span>
                                       <select class="form-control select2" id="categories" name="categories[]" multiple >
                                           @foreach(\App\Category::where('parent_id','<>',0)->get() as $category)
                                               <option value="{{$category->id}}">{{$category->name}}</option>
                                               @endforeach
                                       </select>
                                   </div>
                                   <div class="col-1">
                                       <span>&nbsp</span>
                                       <button type="submit" class="btn btn-primary">Add</button>
                                   </div>
                               </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Categories</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($specifications as $specification)
                                        <tr>
                                            <td>{{$specification->name}}</td>
                                            <td>@foreach($specification->categories as $category){{$category->name}}, @endforeach</td>
                                            <td class="product-action">
                                                <a href="{{url('/dashboard/product-specifications/edit')."/".$specification->id}}" title="Edit Specification" id="btn_update_specification"><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/product-specifications/delete')."/".$specification->id}}"><i class="feather icon-trash danger"></i></a>
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

        $(function () {

            @if(!empty($specs))
            var categoryArray = @json($specs['spec_categories']);
                $.each(categoryArray,function (key,value) {
                        $.each($('body').find('#categories option'),function () {
                        if($(this).val()==value)
                        {
                             $(this).attr('selected','selected');
                        }
                    });
                });
            $('body').find('button[type="submit"]').text('Update');
            @endif
        })

    </script>

@endsection
