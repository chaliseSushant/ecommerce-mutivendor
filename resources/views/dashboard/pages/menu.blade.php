@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_menu" data-target="#modal_add_new_menu">Add New Menu</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($parent_menus as $child_menu)
                                        @if($child_menu->hasChild())
                                            <tr class="table-primary">
                                                <td><i class="fa fa-circle"></i> {{$child_menu->name}}</td>
                                                <td>{{$child_menu->order}}</td>
                                                <td class="product-action">
                                                    <a href="#" data-toggle="modal" title="Edit Menu" id="btn_update_menu" data-target="#modal_update_menu"
                                                       data-id="{{$child_menu->id}}"
                                                       data-name="{{$child_menu->name}}"
                                                       data-order="{{$child_menu->order}}"
                                                       data-parent="{{$child_menu->parent_id}}"
                                                       data-url="{{$child_menu->url}}"
                                                    ><i class="feather icon-edit"></i></a>
                                                    <a class="delete-confirm" href="{{url('/dashboard/menu/delete')."/".$child_menu->id}}"><i class="feather icon-trash danger"></i></a>
                                                </td>
                                            </tr>
                                            @foreach($child_menu->child()->orderBy('order')->get() as $child_menu1)
                                                <tr>
                                                    <td> &nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_menu1->name}}</td>
                                                    <td>{{$child_menu1->order}}</td>
                                                    <td class="product-action">
                                                        <a href="#" data-toggle="modal" title="Edit Menu" id="btn_update_menu" data-target="#modal_update_menu"
                                                           data-id="{{$child_menu1->id}}"
                                                           data-name="{{$child_menu1->name}}"
                                                           data-order="{{$child_menu1->order}}"
                                                           data-parent="{{$child_menu1->parent_id}}"
                                                           data-url="{{$child_menu1->url}}"
                                                        ><i class="feather icon-edit"></i></a>
                                                        <a class="delete-confirm" href="{{url('/dashboard/menu/delete')."/".$child_menu1->id}}"><i class="feather icon-trash danger"></i></a>
                                                    </td>
                                                </tr>
                                                @if($child_menu1->hasChild())
                                                    @foreach($child_menu1->child()->orderBy('order')->get() as $child_menu2)
                                                        <tr>
                                                            <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_menu2->name}}</td>
                                                            <td>{{$child_menu2->order}}</td>
                                                            <td class="product-action">
                                                                <a href="#" data-toggle="modal" title="Edit Menu" id="btn_update_menu" data-target="#modal_update_menu"
                                                                   data-id="{{$child_menu2->id}}"
                                                                   data-name="{{$child_menu2->name}}"
                                                                   data-order="{{$child_menu2->order}}"
                                                                   data-parent="{{$child_menu2->parent_id}}"
                                                                   data-url="{{$child_menu2->url}}"
                                                                ><i class="feather icon-edit"></i></a>
                                                                <a class="delete-confirm" href="{{url('/dashboard/menu/delete')."/".$child_menu2->id}}"><i class="feather icon-trash danger"></i></a>
                                                            </td>
                                                        </tr>
                                                        @if($child_menu2->hasChild())
                                                            @foreach($child_menu2->child()->orderBy('order')->get() as $child_menu3)
                                                                <tr>
                                                                    <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-long-arrow-right"></i> {{$child_menu3->name}}</td>
                                                                    <td>{{$child_menu3->order}}</td>
                                                                    <td class="product-action">
                                                                        <a href="#" data-toggle="modal" title="Edit Menu" id="btn_update_menu" data-target="#modal_update_menu"
                                                                           data-id="{{$child_menu3->id}}"
                                                                           data-name="{{$child_menu3->name}}"
                                                                           data-order="{{$child_menu3->order}}"
                                                                           data-parent="{{$child_menu3->parent_id}}"
                                                                           data-url="{{$child_menu3->url}}"
                                                                        ><i class="feather icon-edit"></i></a>
                                                                        <a class="delete-confirm" href="{{url('/dashboard/menu/delete')."/".$child_menu3->id}}"><i class="feather icon-trash danger"></i></a>
                                                                    </td>
                                                                </tr>

                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @else
                                            <tr class="table-primary">
                                                <td><i class="fa fa-circle"></i> {{$child_menu->name}}</td>
                                                <td>{{$child_menu->order}}</td>
                                                <td class="product-action">
                                                    <a href="#" data-toggle="modal" title="Edit Menu" id="btn_update_menu" data-target="#modal_update_menu"
                                                       data-id="{{$child_menu->id}}"
                                                       data-name="{{$child_menu->name}}"
                                                       data-order="{{$child_menu->order}}"
                                                       data-parent="{{$child_menu->parent_id}}"
                                                       data-url="{{$child_menu->url}}"
                                                    ><i class="feather icon-edit"></i></a>
                                                    <a class="delete-confirm" href="{{url('/dashboard/menu/delete')."/".$child_menu->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_new_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.menu_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.menu_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_menu').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var name = link.data('name');
                var order = link.data('order');
                var parent = link.data('parent');
                var url = link.data('url');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #order').val(order);
                modal.find('.modal-body #parent').val(parent);
                modal.find('.modal-body #url').val(url);


            })
        })

    </script>

@endsection
