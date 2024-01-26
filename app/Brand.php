<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Brand extends Model
{
    use Searchable;
    public function searchableAs()
    {
        return 'brand_index';
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
        return $this->hasMany('App\Product');
    }
    public function listProducts()
    {
        $products[$this->id] = Cache::remember('category_products_'.$this->id, 22*60, function() {
            return $this->products;
        });
        return $products[$this->id];
    }
    public function card()
    {
        $data['type'] = 'brand';
        $data['url'] = '/brand/'.$this->id;
        $data['image'] = $this->icon;
        $data['title'] = $this->name;

        return $data;
    }
}
