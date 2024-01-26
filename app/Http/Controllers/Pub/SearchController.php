<?php

namespace App\Http\Controllers\Pub;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

class SearchController extends Controller
{
    public function searchSubmit(Request $request)
    {
        if ($request->search == null)
        {
            return redirect()->back();
        }
        else
        {

            $searchdata = [
                'term' => $request->search,
                'in' => ['product']
                ];
            return redirect(URL::Route('search', $searchdata));
        }
    }
    public function searchPriceSubmit(Request $request)
    {
        $searchdata = $request->query();
        unset($searchdata['maxprice']);
        unset($searchdata['minprice']);
        $searchdata['minprice'] = trim(explode('-',$request->price)[0]);
        $searchdata['maxprice'] = trim(explode('-',$request->price)[1]);
        return redirect(URL::Route('search', $searchdata));
    }
    public function index(Request $request)
    {
        $encoded_query = json_encode($request->query());
        $value[$encoded_query] = Cache::remember($encoded_query, 22*60, function () use ($request) {

            return $this->requestCache($request);
        });
        return view('frontend.pages.search')
            ->with('search_data',$value[$encoded_query]['search_data'])
            ->with('associated_categories',$value[$encoded_query]['associated_categories'])
            ->with('associated_brands',$value[$encoded_query]['associated_brands'])
            ->with('term',$value[$encoded_query]['term'])
            ->with('type',$value[$encoded_query]['type']);


    }
    public function requestCache($request)
    {
        $associated_brands = null;
        $associated_categories = null;
        if (array_key_exists('in',$request->toArray()) && in_array('product',$request->in) && $request->term != null)
        {
            $data = $this->products($request->term);
            if (!isset($search_data)) {
                $search_data = $data;
            }
            else
            {
                $search_data = $search_data->merge($data);
            }
            if ($search_data->count() != 0)
            {
                foreach ($search_data as $datum)
                {
                    if (!isset($brand_ids))
                    {
                        $brand_ids = collect();
                    }
                    $brand_ids = $brand_ids->merge($datum->brand->id)->unique();
                    if (!isset($category_ids))
                    {
                        $category_ids = $datum->categories_id();
                    }
                    else
                    {
                        $category_ids = $category_ids->merge($datum->categories_id())->unique();
                    }
                }
                $associated_brands = Brand::whereIn('id',$brand_ids)->get()->sortBy('name');
                $associated_categories = Category::whereIn('id',$category_ids)->get()->sortBy('name');
            }
        }
        if (array_key_exists('in',$request->toArray()) && in_array('brand',$request->in) && $request->term != null)
        {
            $data = $this->brands($request->term);
            if (!isset($search_data)) {
                $search_data = $data;

            } else {
                $search_data = $search_data->merge($data);
            }

        }
        if (array_key_exists('in',$request->toArray()) && in_array('category',$request->in) && $request->term != null)
        {
            $data = $this->categories($request->term);


            if (!isset($search_data)) {
                $search_data = $data;
            }
            else {
                $search_data = $search_data->merge($data);
            }
        }
        if (isset($search_data))
        {
            if (array_key_exists('category',$request->toArray()))
            {
                $search_data = $this->inCategory($search_data,$request->category);
            }
            if (array_key_exists('brand',$request->toArray()))
            {
                $search_data = $this->inBrand($search_data, $request->brand);
            }
            //Not In Use
            if (array_key_exists('brands',$request->toArray()))
            {
                $search_data = $this->inBrands($search_data, $request->brands);
            }
        }
        else
        {
            if (array_key_exists('category',$request->toArray()))
            {
                $category = Category::find($request->category);
                if (isset($category))
                {
                    $search_data = $category->listProducts();
                    if ($search_data->count() != 0)
                    {
                        foreach ($search_data as $datum)
                        {
                            if (!isset($brand_ids))
                            {
                                $brand_ids = collect();
                            }
                            $brand_ids = $brand_ids->merge($datum->brand->id)->unique();
                            if (!isset($category_ids))
                            {
                                $category_ids = $datum->categories_id();
                            }
                            else
                            {
                                $category_ids = $category_ids->merge($datum->categories_id())->unique();
                            }
                        }
                        $associated_brands = Brand::whereIn('id',$brand_ids)->get()->sortBy('name');
                        $associated_categories = Category::whereIn('id',$category_ids)->get()->sortBy('name');
                    }
                }

            }
            if (array_key_exists('brand',$request->toArray()))
            {
                $brand = Brand::find($request->brand);
                if (isset($brand))
                {
                    $search_data = $brand->listProducts();
                    if ($search_data->count() != 0)
                    {
                        foreach ($search_data as $datum)
                        {
                            if (!isset($brand_ids))
                            {
                                $brand_ids = collect();
                            }
                            $brand_ids = $brand_ids->merge($datum->brand->id)->unique();
                            if (!isset($category_ids))
                            {
                                $category_ids = $datum->categories_id();
                            }
                            else
                            {
                                $category_ids = $category_ids->merge($datum->categories_id())->unique();
                            }
                        }
                        $associated_brands = Brand::whereIn('id',$brand_ids)->get()->sortBy('name');
                        $associated_categories = Category::whereIn('id',$category_ids)->get()->sortBy('name');
                    }
                }
            }
        }
        if (array_key_exists('certified', $request->toArray()))
        {
            if ($request->certified == 'true')
            {
                $search_data = $this->isCertified($search_data);
            }
        }
        if (array_key_exists('instant', $request->toArray()))
        {
            if ($request->instant == 'true')
            {
                $search_data = $this->isInstant($search_data);
            }
        }
        if (array_key_exists('maxprice', $request->toArray()))
        {
            $search_data = $this->maxPrice($search_data,$request->maxprice);
        }
        if (array_key_exists('minprice', $request->toArray()))
        {
            $search_data = $this->minPrice($search_data,$request->minprice);
        }
        if (array_key_exists('sortBy',$request->toArray()))
        {
            $search_data = $this->sort($search_data,$request->sortBy);
        }

        $cached['search_data'] = $search_data;
        $cached['associated_categories'] = $associated_categories;
        $cached['associated_brands'] = $associated_brands;
        $cached['term' ] = $request->term;
        $cached['type'] = 'search';

        return $cached;

        /*return view('frontend.pages.search')
            ->with('search_data',$search_data)
            ->with('associated_categories',$associated_categories)
            ->with('associated_brands',$associated_brands)
            ->with('term',$request->term)
            ->with('type','search');*/

    }
    public function sort($search_data, $sort_by)
    {
        if ($sort_by == 'asc')
        {
            $search_data = $search_data->sortBy('name');
        }
        if ($sort_by == 'desc')
        {
            $search_data = $search_data->sortByDesc('name');
        }
        if ($sort_by == 'price-asc')
        {
            $search_data = $search_data->sortBy('price');
        }
        if ($sort_by == 'price-desc')
        {
            $search_data = $search_data->sortByDesc('price');
        }
        if ($sort_by == 'rating-asc')
        {
            $search_data = $search_data->sortBy('rating');
        }
        if ($sort_by == 'rating-desc')
        {
            $search_data = $search_data->sortByDesc('rating');
        }
        return $search_data;

    }
    /*SEARCH TERM IN PRODUCTS*/
    public function products($query)
    {
        return Product::search($query)->get();
    }
    /*SEARCH TERM IN BRANDS*/
    public function brands($query)
    {
        return Brand::search($query)->get();
    }
    /*SEARCH TERM IN CATEGORIES*/
    public function categories($query)
    {
        return Category::search($query)->get();
    }
    /*FILTER SEARCH DATA WITH MAX PRICE*/
    public function maxPrice($search_data, $price)
    {
        return $search_data->where('price','<=',$price);
    }
    /*FILTER SEARCH DATA WITH MIN PRICE*/
    public function minPrice($search_data, $price)
    {
        return $search_data->where('price','>=',$price);
    }
    /*FILTER SEARCH DATA WITH SINGLE CATEGORY*/
    public function inCategory($search_data, $cat_id)
    {
        $id_array = collect();
        foreach ($search_data as $datum)
        {
            if($datum->getTable() == 'products')
            {
                if ($datum->belongsToCategory($cat_id) == true)
                {
                    if (!isset($id_array)) {
                        $id_array = $datum->id;
                    }
                    else
                    {
                        $id_array = $id_array->merge($datum->id);
                    }
                }
            }
        }
        return Product::whereIn('id',$id_array)->get();
    }
    /*FILTER SEARCH DATA WITH SINGLE BRAND*/
    public function inBrand($search_data,$brand_id)
    {
        return $search_data->where('brand_id', $brand_id);
    }
    /*FILTER SEARCH DATA WITH MULTIPLE BRANDS*/
    public function inBrands($search_data,$brand_id_array)
    {
        //dd($search_data->whereIn('brand_id', $brand_id_array));
        return $search_data->whereIn('brand_id', $brand_id_array);
    }
    /*FILTER BY INSTANT*/
    public function isInstant($search_data)
    {
        $id_array = collect();
        foreach ($search_data as $datum)
        {
            if($datum->getTable() == 'products')
            {
                if ($datum->instant_delivery == true)
                {
                    if (!isset($id_array)) {
                        $id_array = $datum->id;
                    }
                    else
                    {
                        $id_array = $id_array->merge($datum->id);
                    }
                }
            }
        }
        return Product::whereIn('id',$id_array)->get();
    }
    /*FILTER BY CERTIFIED*/
    public function isCertified($search_data)
    {
        $id_array = collect();
        foreach ($search_data as $datum)
        {
            if($datum->getTable() == 'products')
            {
                if ($datum->vendor->certified == true)
                {
                    if (!isset($id_array)) {
                        $id_array = $datum->id;
                    }
                    else
                    {
                        $id_array = $id_array->merge($datum->id);
                    }
                }
            }
        }
        return Product::whereIn('id',$id_array)->get();
    }
}
