@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="card-header">
                               <h4>Please fill the information below</h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-vertical" novalidate method="post" action="/dashboard/page/saveUpdate">
                                    @csrf
                                    <input type="hidden" @if(isset($page)) value="{{$page->id}}" @endif name="id">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title-vertical" class="font-medium">Title</label>
                                                    <input type="text" required data-validation-required-message="Title field is required" id="title-vertical" @if(isset($page->title)) value="{{$page->title}}" @endif class="form-control" name="title" placeholder="Page Title">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title-vertical" class="font-medium">Slug</label>
                                                    <input type="text" required data-validation-required-message="Slug field is required" id="title-vertical" @if(isset($page)) value="{{$page->slug}}" @endif class="form-control" name="slug" placeholder="Slug">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title-vertical" class="font-medium">Meta Description</label>
                                                    <textarea rows="5" class="form-control" id="meta_description" name="meta_description">@if(isset($page->meta_description)) {{$page->meta_description}} @endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title-vertical" class="font-medium">Description</label>
                                                    <textarea rows="7" class="form-control editor" id="editor" name="description">@if(isset($page->description)) {{$page->description}} @endif</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
