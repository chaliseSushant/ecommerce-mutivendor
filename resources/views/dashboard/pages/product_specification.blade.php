@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
      <div class="card">
          <div class="card-body">
              <form role="form form-horizontal" novalidate class="row" method="post" action="/dashboard/vendor/products/specification_value/saveUpdate">
                  @csrf
                  <input type="hidden" id="id" name="id">
                  <input type="hidden" name="product_id" @if(isset($product_id)) value="{{$product_id}}" @endif>
                  <div class="col-12">
                      <div class="row">
                          <div class="col-4 controls" >
                              <label for="specification_value">Specification Value</label>
                              <input type="text" id="specification_value" required data-validation-required-message="Specification Value field is required" class="form-control" name="value" placeholder="Enter Value">
                          </div>
                          <div class="col-4 controls" >
                              <label for="specification_title">Specification Title</label>
                              <select name="specification_id" required data-validation-required-message="Specification Title field is required" class="form-control" name="specification_id" id="specification_title">
                                  @foreach($specification_titles as $specification_title)
                                      <option value="{{$specification_title->id}}">{{$specification_title->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-4">
                              <button class="btn btn-primary" type="submit" style="margin-top:17px" id="add_specification">Add</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Value</th>
                                        <th>Specification</th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($specification_values as $specification_value)
                                        <tr>
                                            <td>{{$specification_value->value}}</td>
                                            <td>{{$specification_value->specification->name}}</td>
                                            <td class="product-action">
                                                <a href="#"  class="btn_update_specification_value"
                                                   data-id="{{$specification_value->id}}"
                                                   data-value="{{$specification_value->value}}"
                                                   data-specification_id="{{$specification_value->specification_id}}"


                                                ><i class="feather icon-edit"></i></a>
                                                <a class="delete-confirm" href="{{url('/dashboard/vendor/products/specification_value/delete/')."/".$specification_value->id}}"><i class="feather icon-trash danger"></i></a>
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


            $('.btn_update_specification_value').on('click',function (e) {

                var id = $(this).attr('data-id');
                var specification_value = $(this).attr('data-value');
                var specification_title = $(this).attr('data-specification_id');

                $('#id').val(id);
                $('#specification_value').val(specification_value);
                $('#specification_title').val(specification_title);
                $('#add_specification').text('Update');

            })

        })
    </script>
@endsection

