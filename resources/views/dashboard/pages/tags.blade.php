@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_tag" data-target="#modal_add_new_tag">Add New Tag</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Keyword</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td>{{$tag->keyword}}</td>
                                            <td class="product-action">
                                                <a href="#" data-toggle="modal" id="btn_update_tag" data-target="#modal_update_tag"
                                                   data-id="{{$tag->id}}"
                                                   data-keyword="{{$tag->keyword}}"
                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/tag/delete')."/".$tag->id}}"><i class="feather icon-trash danger"></i></a>
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
    <div class="modal fade text-left" id="modal_add_new_tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.tag_add_edit',['addEdit'=>'Add','saveUpdate'=>'Save'])
    </div>
    <div class="modal fade text-left" id="modal_update_tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.tag_add_edit',['addEdit'=>'Update','saveUpdate'=>'Update'])
    </div>
    <script>

        $(function () {
            $('#modal_update_tag').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var keyword = link.data('keyword');

                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #keyword').val(keyword);


            })
        })

    </script>

@endsection
