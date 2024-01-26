@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_category" data-target="#modal_add_new_category">Add New Category</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Fees</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($parent_categories as $child_category)
                                        @if($child_category->hasChild())
                                            <tr class="table-primary">
                                                <td><i class="fa fa-circle"></i> {{$child_category->name}}</td>
                                                <td>{{$child_category->commission}}</td>
                                                <td class="product-action">
                                                    <a href="#" data-toggle="modal" title="Edit category" id="btn_update_category" data-target="#modal_update_category"
                                                       data-id="{{$child_category->id}}"
                                                       data-name="{{$child_category->name}}"
                                                       data-commission="{{$child_category->commission}}"
                                                       data-parent="{{$child_category->parent_id}}"
                                                    ><i class="feather icon-edit"></i></a>
                                                    <a class="delete-confirm" href="{{url('/dashboard/category/delete')."/".$child_category->id}}"><i class="feather icon-trash danger"></i></a>
                                                </td>
                                            </tr>
                                            @foreach($child_category->child()->get() as $child_category1)
                                                <tr>
                                                    <td> &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_category1->name}}</td>
                                                    <td>{{$child_category1->commission}}</td>
                                                    <td class="product-action">
                                                        <a href="#" data-toggle="modal" title="Edit category" id="btn_update_category" data-target="#modal_update_category"
                                                           data-id="{{$child_category1->id}}"
                                                           data-name="{{$child_category1->name}}"
                                                           data-commission="{{$child_category1->commission}}"
                                                           data-parent="{{$child_category1->parent_id}}"
                                                        ><i class="feather icon-edit"></i></a>
                                                        <a class="delete-confirm" href="{{url('/dashboard/category/delete')."/".$child_category1->id}}"><i class="feather icon-trash danger"></i></a>
                                                    </td>
                                                </tr>
                                                @if($child_category1->hasChild())
                                                    @foreach($child_category1->child()->get() as $child_category2)
                                                        <tr>
                                                            <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_category2->name}}</td>
                                                            <td>{{$child_category2->commission}}</td>
                                                            <td class="product-action">
                                                                <a href="#" data-toggle="modal" title="Edit category" id="btn_update_category" data-target="#modal_update_category"
                                                                   data-id="{{$child_category2->id}}"
                                                                   data-name="{{$child_category2->name}}"
                                                                   data-commission="{{$child_category2->commission}}"
                                                                   data-parent="{{$child_category2->parent_id}}"
                                                                ><i class="feather icon-edit"></i></a>
                                                                <a class="delete-confirm" href="{{url('/dashboard/category/delete')."/".$child_category2->id}}"><i class="feather icon-trash danger"></i></a>
                                                            </td>
                                                        </tr>
                                                        @if($child_category2->hasChild())
                                                            @foreach($child_category2->child()->get() as $child_category3)
                                                                <tr>
                                                                    <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_category3->name}}</td>
                                                                    <td>{{$child_category3->commission}}</td>
                                                                    <td class="product-action">
                                                                        <a href="#" data-toggle="modal" title="Edit category" id="btn_update_category" data-target="#modal_update_category"
                                                                           data-id="{{$child_category3->id}}"
                                                                           data-name="{{$child_category3->name}}"
                                                                           data-commission="{{$child_category3->commission}}"
                                                                           data-parent="{{$child_category3->parent_id}}"
                                                                        ><i class="feather icon-edit"></i></a>
                                                                        <a class="delete-confirm" href="{{url('/dashboard/category/delete')."/".$child_category3->id}}"><i class="feather icon-trash danger"></i></a>
                                                                    </td>
                                                                </tr>

                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @else
                                            <tr class="table-primary">
                                                <td><i class="fa fa-circle"></i> {{$child_category->name}}</td>
                                                <td>{{$child_category->commission}}</td>
                                                <td class="product-action">
                                                    <a href="#" data-toggle="modal" title="Edit category" id="btn_update_category" data-target="#modal_update_category"
                                                       data-id="{{$child_category->id}}"
                                                       data-name="{{$child_category->name}}"
                                                       data-commission="{{$child_category->commission}}"
                                                       data-parent="{{$child_category->parent_id}}"
                                                       data-url="{{$child_category->url}}"
                                                    ><i class="feather icon-edit"></i></a>
                                                    <a class="delete-confirm" href="{{url('/dashboard/category/delete')."/".$child_category->id}}"><i class="feather icon-trash danger"></i></a>
                                                </td>
                                            </tr>
                                        @endif

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
    <div class="modal fade text-left" id="modal_add_new_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.category_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.category_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_category').on('shown.bs.modal',function (e) {

                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var name = link.data('name');
                var commission = link.data('commission');
                var parent = link.data('parent');
                var description = link.data('description');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #commission').val(commission);
                modal.find('.modal-body #parent').val(parent);
                modal.find('.modal-body #description').text(description);


            })
        })

    </script>

@endsection
