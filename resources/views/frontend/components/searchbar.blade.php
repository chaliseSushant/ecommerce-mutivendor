<div class="container search-section">
    <div class="row">
        @if($associated_categories)
            <div class="col-12 sub-section">
                <span class="subsection-title">Filter By Categories:</span>
                <ul class="searchlist">
                    @foreach($associated_categories as $category)
                        @php
                            $request_var = Request::query();
                            if (array_key_exists('category',$request_var))
                            {
                                if ($request_var['category'] == $category->id)
                                {
                                    $selected = true;
                                    $category_collection = \App\Category::find($request_var['category']);
                                    $parent_id = $category_collection->parent_id;
                                    if (isset($category_collection) && $parent_id != null)
                                    {
                                        unset($request_var['category']);
                                        $request_var['category'] = $parent_id;

                                    }
                                    $url = URL::Route('search',$request_var);

                                }
                                else
                                {
                                    $selected = false;
                                    unset($request_var['category']);
                                    $request_var['category'] = $category->id;
                                    $url = URL::Route('search',$request_var);
                                }
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['category']);
                                $request_var['category'] = $category->id;
                                $url = URL::Route('search',$request_var);
                            }
                        @endphp
                        <li class="checklist @if($selected) active @endif"><a href="{{$url}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if($associated_brands)
        <div class="col-12 sub-section">
            <span class="subsection-title">Filter By Brands:</span>
            <ul class="searchlist">
                @foreach($associated_brands as $brand)
                    @php
                        $request_var = Request::query();
                        if (array_key_exists('brand',$request_var))
                        {
                            if ($request_var['brand'] == $brand->id)
                            {
                                $selected = true;
                                if ($associated_brands->count() >= 2)
                                {
                                    unset($request_var['brand']);
                                }
                                $url = URL::Route('search',$request_var);
                            }
                            else
                            {
                                $selected = false;
                                unset($request_var['brand']);
                                $request_var['brand'] = $brand->id;
                                $url = URL::Route('search',$request_var);
                            }
                        }
                        else
                        {
                            $selected = false;
                            unset($request_var['brand']);
                            $request_var['brand'] = $brand->id;
                            $url = URL::Route('search',$request_var);
                        }
                    @endphp
                <li class="checklist @if($selected) active @endif"><a href="{{$url}}">{{$brand->name}}</a></li>
                @endforeach
            </ul>
        </div>
        @endif
        @php
                    $request_var = Request::query();
                    $include = false;
                    if (array_key_exists('term',$request_var))
                    {
                        $include = true;
                    }
            @endphp
        @if($include == true)
                <div class="col-12 sub-section">
                    <span class="subsection-title">Include :</span>
                    <ul class="searchlist">
                        @php
                            $request_var = Request::query();
                            if (array_key_exists('in',$request_var))
                            {
                                if (in_array('product', $request_var['in']))
                                {
                                    $selected = true;
                                }
                                else
                                {
                                    $selected = false;
                                }
                            }
                            else
                            {
                                $selected = false;
                            }
                                unset($request_var['in']);
                                $request_var['in'] = ['product'];
                                $url = URL::Route('search',$request_var);
                        @endphp
                        <li class="checklist @if($selected) active @endif"><a href="{{$url}}">Product</a></li>
                        @php
                            $request_var = Request::query();
                            if (array_key_exists('in',$request_var))
                            {
                                if (in_array('brand', $request_var['in']))
                                {
                                    $selected = true;
                                }
                                else
                                {
                                    $selected = false;
                                }
                            }
                            else
                            {
                                $selected = false;
                            }
                                unset($request_var['in']);
                                unset($request_var['category']);
                                unset($request_var['brand']);
                                $request_var['in'] = ['brand'];
                                $url = URL::Route('search',$request_var);
                        @endphp
                        <li class="checklist @if($selected) active @endif"><a href="{{$url}}">Brand</a></li>
                        @php
                            $request_var = Request::query();
                            if (array_key_exists('in',$request_var))
                            {
                                if (in_array('category', $request_var['in']))
                                {
                                    $selected = true;
                                }
                                else
                                {
                                    $selected = false;
                                }
                            }
                            else
                            {
                                $selected = false;
                            }
                                unset($request_var['in']);
                                unset($request_var['category']);
                                unset($request_var['brand']);
                                $request_var['in'] = ['category'];
                                $url = URL::Route('search',$request_var);
                        @endphp
                        <li class="checklist @if($selected) active @endif"><a href="{{$url}}">Category</a></li>
                    </ul>
                </div>
            @endif
        @php
            $request_var = Request::query();
            $product_search = false;
            if (array_key_exists('category', $request_var) || array_key_exists('brand', $request_var))
            {
                $product_search = true;
            }
            if (array_key_exists('in',$request_var) && in_array('product', $request_var['in']))
            {
              $product_search = true;
            }
        @endphp
        @if($product_search)
    <div class="col-12 sub-section">
        <span class="subsection-title">Filter By :</span>
    <ul class="searchlist">
    @php
        $request_var = Request::query();
        if (array_key_exists('certified',$request_var))
        {
            if ($request_var['certified'] == 'true')
            {
                $selected = true;
                unset($request_var['certified']);
            }
            else
            {
                $selected = false;
                unset($request_var['certified']);
                $request_var['certified'] = 'true';
                unset($request_var['in']);
                $request_var['in'] = ['product'];
            }
        }
        else
        {
            $selected = false;
            unset($request_var['certified']);
            $request_var['certified'] = 'true';
            unset($request_var['in']);
            $request_var['in'] = ['product'];
        }
            $url = URL::Route('search',$request_var);
            @endphp
            <li class="checklist @if($selected) active @endif"><a href="{{$url}}">Certified Store</a></li>
            @php
                $request_var = Request::query();
                if (array_key_exists('instant',$request_var))
                {
                    if ($request_var['instant'] == 'true')
                    {
                        $selected = true;
                        unset($request_var['instant']);
                    }
                    else
                    {
                        $selected = false;
                        unset($request_var['instant']);
                        $request_var['instant'] = 'true';
                        unset($request_var['in']);
                        $request_var['in'] = ['product'];
                    }
                }
                else
                {
                    $selected = false;
                    unset($request_var['instant']);
                    $request_var['instant'] = 'true';
                    unset($request_var['in']);
                    $request_var['in'] = ['product'];
                }
                    $url = URL::Route('search',$request_var);
            @endphp
            <li class="checklist @if($selected) active @endif"><a href="{{$url}}">Instant Delivery</a></li>
        </ul>
    </div>
    <section class="col-12 sub-section price-slider">
        <span class="subsection-title">Filter By Price:</span>
        <form id="submit_price" method="post" action="{{URL::Route('searchprice',Request::query())}}">
            @csrf
            <input type="text" name="price" id="amount" readonly>
            <div id="slider-range"></div>
            @php
                $request_var =Request::query();
                unset($request_var['maxprice']);
                unset($request_var['minprice']);
                $reset_url = URL::Route('search', $request_var);
                @endphp
                <section class="slider-links">
                    <a onclick="document.getElementById('submit_price').submit();">Apply</a>
                    <a href="{{$reset_url}}">Reset</a>
                </section>
            </form>
        </section>
    @endif
    </div>
</div>
