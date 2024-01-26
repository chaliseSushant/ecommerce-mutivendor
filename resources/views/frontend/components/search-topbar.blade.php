<div class="col-12 action-bar">
    <div class="container">
        <div class="row">
            @php
                $request_var = Request::query();
                 if (array_key_exists('in',$request_var))
                 {
                     if (in_array('category', $request_var['in']))
                     {
                        if ($search_data->count() != 1)
                        {
                            $items = 'categories';
                        }
                        else
                        {
                            $items = 'category';
                        }
                     }
                     elseif (in_array('brand', $request_var['in']))
                     {
                        if ($search_data->count() != 1)
                        {
                            $items = 'brands';
                        }
                        else
                        {
                            $items = 'brand';
                        }
                     }
                     else
                     {
                        if ($search_data->count() != 1)
                        {
                            $items = 'items';
                        }
                        else
                        {
                            $items = 'item';
                        }
                     }
                 }
                 else
                 {
                     if ($search_data->count() != 1)
                         {
                             $items = 'items';
                         }
                         else
                         {
                             $items = 'item';
                         }
                 }
                 $term_data = $term ;
                 $joiner = 'for';
                 if (array_key_exists('category',$request_var))
                 {
                    $term_data = \App\Category::find($request_var['category'])->name;
                    $joiner = 'in category';
                 }
                 if (array_key_exists('brand',$request_var))
                 {
                    $term_data = \App\Brand::find($request_var['brand'])->name;
                    $joiner = 'in brand';
                 }
            @endphp
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 center-wrapper"><span>{{$search_data->count()}} {{$items}} found {{$joiner}} "{{$term_data}}".</span></div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 center-wrapper text-right">
                <span>Sort By: </span>
                <select class="sort-selection" name="sort" id="sortProduct" onchange="sortSearchProducts()">
                    @php
                        $request_var = Request::query();
                        if (!array_key_exists('sortBy',$request_var))
                        {
                            $selected = true;
                        }
                        else
                        {
                            $selected = false;
                        }
                        unset($request_var['sortBy']);
                        $url = URL::Route('search',$request_var);
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}"><i>None</i></option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'asc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'asc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'asc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'asc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Ascending</option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'desc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'desc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'desc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'desc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Descending</option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'price-asc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'price-asc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'price-asc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'price-asc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Price - Ascending</option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'price-desc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'price-desc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'price-desc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'price-desc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Price - Descending</option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'rating-asc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'rating-asc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'rating-asc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'rating-asc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Ratings - Ascending</option>
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('sortBy',$request_var))
                        {
                            if ($request_var['sortBy'] == 'rating-desc')
                            {
                                $selected = true;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'rating-desc';
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['sortBy']);
                                $request_var['sortBy'] = 'rating-desc';
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['sortBy']);
                            $request_var['sortBy'] = 'rating-desc';
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                    <option @if($selected) selected @endif value="{{$url}}">Ratings - Descending</option>
                </select>

            </div>
        </div>
    </div>
</div>
