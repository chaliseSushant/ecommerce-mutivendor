@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/dashboard/page/create" class="btn btn-primary"  id="btn_add_new_category">Add New Page</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->slug}}</td>
                                            <td class="product-action">
                                                <a href="{{url('/dashboard/page/create/'.$page->id)}}"><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/pages/delete')."/".$page->id}}"><i class="feather icon-trash danger"></i></a>
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
@endsection
