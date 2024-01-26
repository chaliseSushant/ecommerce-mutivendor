@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
           <div class="col-12">
             <div class="card">
                 <div class="card-header">
                     <a href="#" class="btn btn-primary" data-toggle="modal" id="btn_add_new_container" data-target="#modal_add_update_container">Add New Container</a>
                 </div>
                 <div class="card-content">
                     <div class="card-body">
                         <h3>Containers</h3>
                         <ul class="list-group" id="basic-list-group1">
                             @foreach($containers as $container)
                             <li class="list-group-item" id="{{$container->id}}">
                                 <div class="col-12">
                                     <div class="media">
                                         <div class="media-body">
                                             <h5 class="mt-0">{{$container->title}}</h5><a href="#" data-toggle="modal" data-target="#modal_add_update_container"
                                                  data-id="{{$container->id}}"
                                                  data-template_id="{{$container->template_id}}"
                                                  data-type="{{$container->type}}"
                                                  data-order="{{$container->order}}"
                                                  data-type_id="{{$container->type_id}}"
                                                  data-title="{{$container->title}}"
                                                  data-url="{{$container->url}}"
                                             ><i class="feather icon-edit text-info font-medium-3"></i></a>
                                         </div>
                                         <div class="media-body">
                                             <h5 class="mt-0">{{$container->type}}</h5>
                                         </div>
                                         <div class="media-body">
                                             <h5 class="mt-0">{{$container->type_id}}</h5>
                                         </div>
                                         <div class="media-body">
                                            <a href="{{url('/dashboard/homepage_layout/delete/').DIRECTORY_SEPARATOR.$container->id}}" class="delete-confirm"><i class="feather icon-trash text-danger font-medium-3"></i></a>
                                         </div>
                                     </div>
                                 </div>
                                 @if($container->type == null)
                                 <div class="row" id="card-drag-area">
                                     @for($i = 0;$i<$container->template->size;$i++)
                                         <div class="col-xl-2 col-md-4 col-sm-6">
                                             <div class="card">
                                                 <div class="card-content">
                                                     <div class="card-body">
                                                         <h4 class="text-bold-700 type-capital">{{$container->cards[$i]->type}}</h4>
                                                         <p class="mb-0 line-ellipsis">{{$container->cards[$i]->type_id}}</p>
                                                         <div class="avatar bg-rgba-info p-30 m-0 mb-1 ml-25 text-right">
                                                             <div class="avatar-content">
                                                                 <a href="#" data-toggle="modal" data-target="#modal_update_card"
                                                                    data-id="{{$container->cards[$i]->id}}"
                                                                    data-order="{{$container->cards[$i]->order}}"
                                                                    data-type="{{$container->cards[$i]->type}}"
                                                                    data-url="{{$container->cards[$i]->url}}"
                                                                    data-image="{{$container->cards[$i]->image}}"
                                                                    data-type_id="{{$container->cards[$i]->type_id}}"
                                                                 ><i class="feather icon-edit text-info font-medium-3"></i></a>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         @endfor
                                 </div>
                                @endif
                             </li>
                             @endforeach
                         </ul>
                     </div>
                 </div>
             </div>
           </div>
        </div>
    </section>
    <div class="modal fade text-left" id="modal_add_update_container" tabindex="-1" role="dialog" aria-labelledby="myModalLabel24" aria-hidden="true">
        @include('dashboard.pages.modals.homepage_layout_modal')
    </div>
    <div class="modal fade text-left" id="modal_update_card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25" aria-hidden="true">
        @include('dashboard.pages.modals.card_layout_modal')
    </div>
    <script>

        $(function () {
            $('.type').on('change',function () {
                var name = $(this).val();
                if(name ==="banner")
                {
                    $('.banner').css('display','block');
                    $('.not-banner').css('display','none');
                }
                else
                {
                    $('.banner').css('display','none');
                    $('.not-banner').css('display','block');

                }
                fillType(name,'container');

            });
            $('.card_type').on('change',function () {
                var name = $(this).val();
                if(name ==="banner")
                {
                    $('.banner').css('display','block');
                    $('.not-banner').css('display','none');
                }
                else
                {
                    $('.banner').css('display','none');
                    $('.not-banner').css('display','block');

                }

                fillType(name,'card');
            });

            var elems = [];

            dragula([$("#basic-list-group1").get(0)])
                .on("dragend", function(el, target, src) {
                    elems = []; // reset elems
                    $(".list-group-item").each(function(idx, elem) {
                        elems.push({'id':parseInt($(elem).attr('id')),'order':idx});
                    });
                    $.ajax({
                        method:'post',
                        url:'/dashboard/homepage_layout/orders/update',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'orders':elems
                        },
                        success:function () {
                            location.reload(true)
                        }
                    })


                    // validate elems are in correct order
                });
            $('.group-name').on('blur',function () {
                var id = $(this).attr('id');
                var value = $(this).val();

                $.ajax({
                    url: "{{ url('/dashboard/homepage_layout/update_grpName') }}",
                    method: 'POST',
                    data: {
                        _token:'{{csrf_token()}}',
                        id:id,
                        name:value
                    },
                    success: function( data ) {
                        toastr.success(data)
                    }
                });
            })

            $('#modal_add_update_container').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var template_id = link.data('template_id');
                var type = link.data('type');
                var title = link.data('title');
                var type_id = link.data('type_id');
                var order = link.data('order');
                var url = link.data('url');


                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #template').val(template_id);
                modal.find('.modal-body #title').val(title);
                if(type === "banner")
                {
                    fillType(type,'container');
                    modal.find('.modal-body #type_id').val(type_id);
                    $('.banner').css('display','block');
                    $('.not-banner').css('display','none');
                    modal.find('.modal-body #icon-image').css('display','block');
                    modal.find('.modal-body #icon-image').attr('src',image);
                    modal.find('.modal-body #url').val(url);
                }
                else {

                    $('.banner').css('display','none');
                    $('.not-banner').css('display','block');
                    fillType(type,'container');

                }
                modal.find('.modal-body #type').val(type);
                modal.find('.modal-body #order').val(order);
            });

            $('#modal_update_card').on('shown.bs.modal',function (e) {
                var modal = $(this);
                var link =  $(e.relatedTarget);
                var id = link.data('id');
                var type = link.data('type');
                var type_id = link.data('type_id');
                var image = link.data('image');
                var url = link.data('url');
                var order = link.data('order');


                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #type').val(type);
                $('body').find('#'+type).attr('checked','true');
                if(type !== "banner")
                {
                    fillType(type,'card');
                    modal.find('.modal-body #card_type_id').val(type_id);
                    $('.banner').css('display','none');
                    $('.not-banner').css('display','block');
                }
                else {
                    $('.banner').css('display','block');
                    $('.not-banner').css('display','none');
                    modal.find('.modal-body #icon-image').css('display','block');
                    modal.find('.modal-body #icon-image').attr('src',image);
                    modal.find('.modal-body #url').val(url);
                }

                modal.find('.modal-body #order').val(order);

            });

        });
        function fillType(name,type) {
            var data = "";
            if(name ==="brand")
                data = @json(App\Brand::all()->pluck('id','name'));
            else if(name ==="none" || name==="banner")
                data = [];
            else if(name ==="category")
                data = @json(App\Category::all()->pluck('id','name'));
            else if(name ==="product")
                data = @json(App\Product::all()->pluck('id','name'));

            if(type==='container')
            {
                $('#type_id').html("");
                $.each(data, function(key, value){
                    $('#type_id').append('<option value="'+value+'">'+key+'</option>');
                });
            }
            else if(type==='card')
            {
                $('#card_type_id').html("");
                $.each(data, function(key, value){
                    $('#card_type_id').append('<option value="'+value+'">'+key+'</option>');
                });
            }

        }
    </script>
@endsection
