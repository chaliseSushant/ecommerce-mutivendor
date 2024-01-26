<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable;
    public function searchableAs()
    {
        return 'category_index';
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
    public function listProducts()
    {
        $products[$this->id] = Cache::remember('category_products_'.$this->id, 22*60, function() {
            return $this->productProcessor();
        });
        return $products[$this->id];
    }
    public function productProcessor()
    {
        if ($this->parent_id != 0)
        {
            $products = $this->products;
        }
        else
        {
            $data = null;
            foreach ($this->childs as $subcategory)
            {
                if ($data == null)
                {
                    $data = $subcategory->products->where('status',1)->where('stock',1)->pluck('id')->toArray();
                }
                else
                {
                    $data = array_merge($data,$subcategory->products->where('status',1)->where('stock',1)->pluck('id')->toArray());
                }

            }
            $products = Product::whereIn('id',$data)->get();
        }
        return $products;
    }
    public function specifications()
    {
        return $this->belongsToMany('App\Specification');
    }
    public function card()
    {
        $data['type'] = 'category';
        $data['url'] = '/category/'.$this->id;
        $data['image'] = '/frontend/images/default_category_thumb.jpg';
        $data['title'] = $this->name;

        return $data;
    }

    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }
    public function child() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }
    public function hasChild()
    {
        return $this->childs->count();
    }
    public function parent()
    {
        return $this->belongsTo('App\Category','parent_id')->with('parent');
    }


}
